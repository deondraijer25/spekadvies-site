export const prerender = false;

export async function POST({ request }) {
  try {
    // 1. Parse request body
    const body = await request.json();
    const {
      name = '',
      phone = '',
      email = '',
      city = '',
      situation = '',
      timeline = '',
      preference = '',
      message = ''
    } = body;
    const serviceType = body['service-type'] || body.serviceType || 'overig';

    // Validate required fields
    if (!name.trim() || !phone.trim() || !email.trim()) {
      return new Response(
        JSON.stringify({ success: false, error: 'Vul alle verplichte velden in (naam, telefoon, e-mail).' }),
        { status: 400, headers: { 'Content-Type': 'application/json' } }
      );
    }

    // 2. Fetch GHL Credentials from Environment variables (with configured fallback)
    const apiKey = import.meta.env.GHL_API_KEY || process.env.GHL_API_KEY || 'pit-1300b7d5-1086-49aa-a077-6369e44465b0';
    const locationId = import.meta.env.GHL_LOCATION_ID || process.env.GHL_LOCATION_ID || 'nGSkiNF1QBLT7slHOGPW';
    const pipelineId = 'TAoxuBj8L0molnqCvgB7';
    const pipelineStageId = '242f8b1b-e497-4aa2-9bff-b052293b90f6';

    // 3. Name parsing (Split first and last name)
    const nameParts = name.trim().split(/\s+/);
    const firstName = nameParts[0] || name.trim();
    const lastName = nameParts.slice(1).join(' ') || '';

    // Map service type to readable label and GHL tag
    const tagMap = {
      'hypotheken': 'hypotheken',
      'starter': 'hypotheken',
      'verzekeringen': 'verzekeringen',
      'aangifte': 'belastingaangifte',
      'belastingaangifte': 'belastingaangifte',
      'vermogen': 'vermogen',
      'vermogensbeheer': 'vermogen',
      'overig': 'overige',
      'overige': 'overige'
    };
    const tag = tagMap[serviceType] || 'overige';

    const labelMap = {
      'hypotheken': 'Hypotheekadvies',
      'starter': 'Startershypotheek',
      'verzekeringen': 'Verzekeringen',
      'aangifte': 'Belastingaangifte',
      'belastingaangifte': 'Belastingaangifte',
      'vermogen': 'Vermogen & Pensioen',
      'vermogensbeheer': 'Vermogen & Pensioen',
      'overig': 'Overige / Anders',
      'overige': 'Overige / Anders'
    };
    const serviceLabel = labelMap[serviceType] || serviceType;

    const cleanSituation = situation?.trim() || 'Niet opgegeven';
    const cleanTimeline = timeline?.trim() || 'Niet opgegeven';
    const cleanPreference = preference?.trim() || 'Niet opgegeven';
    const cleanMessage = message?.trim() || 'Geen extra toelichting ingevuld.';

    // Headers for GoHighLevel REST API
    const ghlHeaders = {
      'Authorization': `Bearer ${apiKey}`,
      'Content-Type': 'application/json',
      'Version': '2021-07-28'
    };

    // ==========================================
    // STAP 1: Contact aanmaken/updaten + Custom Fields vullen
    // ==========================================
    const upsertPayload = {
      firstName,
      lastName,
      phone: phone.trim(),
      email: email.trim(),
      locationId,
      source: 'Website Keuzehulp (spekadvies.nl)',
      customFields: [
        { id: 'JUxucX44sWJqWD4BhkX0', field_value: serviceLabel },
        { id: 'lxVrsr6WZXDuIBVsprNk', field_value: cleanSituation },
        { id: 'uUNpxnkKv71DWF07nwAg', field_value: cleanTimeline },
        { id: 'zSC7vH2DoQkB399Dk4LX', field_value: cleanPreference },
        { id: 'PN1vRTOEby0Z2trJTu9U', field_value: cleanMessage }
      ]
    };
    if (city && city.trim()) {
      upsertPayload.city = city.trim();
    }

    const upsertResponse = await fetch('https://services.leadconnectorhq.com/contacts/upsert', {
      method: 'POST',
      headers: ghlHeaders,
      body: JSON.stringify(upsertPayload)
    });

    if (!upsertResponse.ok) {
      const errorText = await upsertResponse.text();
      console.error('GHL Step 1 Upsert Error:', errorText);
      throw new Error(`Failed to upsert contact: ${upsertResponse.statusText}`);
    }

    const upsertData = await upsertResponse.json();
    const contactId = upsertData.contact?.id;

    if (!contactId) {
      throw new Error('No contact ID returned from upsert response');
    }

    // ==========================================
    // STAP 2: Gestructureerde 5-Staps Notitie toevoegen in GHL
    // ==========================================
    const nowStr = new Date().toLocaleString('nl-NL', { timeZone: 'Europe/Amsterdam' });
    const noteBody =
      `📋 NIEUWE AFSPRAAK-AANVRAAG VIA SPEKADVIES.NL\n` +
      `==================================================\n` +
      `1. Onderwerp:         ${serviceLabel}\n` +
      `2. Gekozen situatie:  ${cleanSituation}\n` +
      `3. Gewenste termijn:  ${cleanTimeline}\n` +
      `4. Voorkeur afspraak: ${cleanPreference}\n` +
      `==================================================\n` +
      `CONTACTGEGEVENS:\n` +
      `• Naam:       ${name.trim()}\n` +
      `• Telefoon:   ${phone.trim()}\n` +
      `• E-mail:     ${email.trim()}\n` +
      `• Woonplaats: ${city?.trim() || 'Niet ingevuld'}\n` +
      `• Datum/tijd: ${nowStr}\n\n` +
      `EXTRA TOELICHTING VAN BEZOEKER:\n` +
      `${cleanMessage}`;

    const noteResponse = await fetch(`https://services.leadconnectorhq.com/contacts/${contactId}/notes`, {
      method: 'POST',
      headers: ghlHeaders,
      body: JSON.stringify({
        body: noteBody
      })
    });

    if (!noteResponse.ok) {
      const errorText = await noteResponse.text();
      console.warn('GHL Step 2 Note Warning:', errorText);
    }

    // ==========================================
    // STAP 3: Slimme Tags toevoegen (incl. 'website-lead' trigger tag)
    // ==========================================
    // Als het contact 'website-lead' al had (bijv. bij herhaald testen), verwijder deze eerst zodat de 'Tag Added' trigger opnieuw afgaat
    if (Array.isArray(upsertData.contact?.tags) && upsertData.contact.tags.includes('website-lead')) {
      await fetch(`https://services.leadconnectorhq.com/contacts/${contactId}/tags`, {
        method: 'DELETE',
        headers: ghlHeaders,
        body: JSON.stringify({ tags: ['website-lead'] })
      });
    }

    const tagsToApply = ['website-lead', tag];

    if (preference) {
      const prefLower = preference.toLowerCase();
      if (prefLower.includes('kantoor')) {
        tagsToApply.push('afspraak-kantoor');
      } else if (prefLower.includes('thuis')) {
        tagsToApply.push('afspraak-thuis');
      } else if (prefLower.includes('telefonisch')) {
        tagsToApply.push('afspraak-telefonisch');
      }
    }

    if (timeline) {
      const timeLower = timeline.toLowerCase();
      if (timeLower.includes('snel')) {
        tagsToApply.push('termijn-zsm');
      } else if (timeLower.includes('maanden')) {
        tagsToApply.push('termijn-1-3-maanden');
      } else if (timeLower.includes('ori')) {
        tagsToApply.push('termijn-orienterend');
      }
    }

    const tagResponse = await fetch(`https://services.leadconnectorhq.com/contacts/${contactId}/tags`, {
      method: 'POST',
      headers: ghlHeaders,
      body: JSON.stringify({
        tags: [...new Set(tagsToApply)]
      })
    });

    if (!tagResponse.ok) {
      const errorText = await tagResponse.text();
      console.warn('GHL Step 3 Tag Warning:', errorText);
    }

    // ==========================================
    // STAP 4: Opportunity aanmaken of updaten in de pijplijn (incl. gekozen Situatie)
    // ==========================================
    const oppTitle = situation && situation.trim()
      ? `${name.trim()} — ${serviceLabel}: ${situation.trim()}`
      : `${name.trim()} — Website Lead (${serviceLabel})`;

    const opportunityResponse = await fetch('https://services.leadconnectorhq.com/opportunities/upsert', {
      method: 'POST',
      headers: ghlHeaders,
      body: JSON.stringify({
        locationId,
        name: oppTitle,
        pipelineId,
        pipelineStageId,
        contactId,
        status: 'open'
      })
    });

    if (!opportunityResponse.ok) {
      const errorText = await opportunityResponse.text();
      console.warn('GHL Step 4 Opportunity Warning:', errorText);
    }

    // ==========================================
    // STAP 5: Directe Workflow Trigger (Fallback zodat SMS/E-mail altijd afgaat)
    // ==========================================
    await fetch(`https://services.leadconnectorhq.com/contacts/${contactId}/workflow/4487dcf1-e769-4a58-bf73-07bb80455f89`, {
      method: 'POST',
      headers: ghlHeaders,
      body: JSON.stringify({})
    }).catch(() => {});

    // Return success to the client
    return new Response(
      JSON.stringify({
        success: true,
        message: 'Aanvraag succesvol verwerkt.',
        contactId
      }),
      { status: 200, headers: { 'Content-Type': 'application/json' } }
    );

  } catch (error) {
    console.error('GHL Integration Server Error:', error);
    return new Response(
      JSON.stringify({ success: false, error: 'Er is een fout opgetreden bij het verwerken van je aanvraag.' }),
      { status: 500, headers: { 'Content-Type': 'application/json' } }
    );
  }
}
