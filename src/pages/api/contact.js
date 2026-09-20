export const prerender = false;

export async function POST({ request }) {
  try {
    // 1. Parse request body
    const body = await request.json();
    const { name, phone, email, 'service-type': serviceType, message } = body;

    // Validate required fields
    if (!name || !phone || !email || !serviceType) {
      return new Response(
        JSON.stringify({ success: false, error: 'Vul alle verplichte velden in.' }),
        { status: 400, headers: { 'Content-Type': 'application/json' } }
      );
    }

    // 2. Fetch GHL Credentials from Environment variables
    const apiKey = import.meta.env.GHL_API_KEY || process.env.GHL_API_KEY;
    const locationId = import.meta.env.GHL_LOCATION_ID || process.env.GHL_LOCATION_ID;

    // Check if configuration exists
    if (!apiKey || !locationId) {
      console.error('Missing GHL credentials in environment variables.');
      return new Response(
        JSON.stringify({ success: false, error: 'Serverconfiguratiefout. Neem contact op met de beheerder.' }),
        { status: 500, headers: { 'Content-Type': 'application/json' } }
      );
    }

    // 3. Name parsing (Split first and last name)
    const nameParts = name.trim().split(/\s+/);
    const firstName = nameParts[0] || '';
    const lastName = nameParts.slice(1).join(' ') || '';

    // Headers for GoHighLevel REST API
    const ghlHeaders = {
      'Authorization': `Bearer ${apiKey}`,
      'Content-Type': 'application/json',
      'Version': '2021-07-28'
    };

    // ==========================================
    // STAP 1: Contact aanmaken of updaten
    // ==========================================
    const upsertResponse = await fetch('https://services.leadconnectorhq.com/contacts/upsert', {
      method: 'POST',
      headers: ghlHeaders,
      body: JSON.stringify({
        firstName,
        lastName,
        phone,
        email,
        locationId
      })
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
    // STAP 2: Tag toevoegen op basis van hulpvraag
    // ==========================================
    let tag = 'overige';
    if (serviceType === 'starter') tag = 'hypotheken';
    else if (serviceType === 'verzekeringen') tag = 'verzekeringen';
    else if (serviceType === 'belastingaangifte') tag = 'belastingaangifte';
    else if (serviceType === 'overige') tag = 'overige';

    const tagResponse = await fetch(`https://services.leadconnectorhq.com/contacts/${contactId}/tags`, {
      method: 'POST',
      headers: ghlHeaders,
      body: JSON.stringify({
        tags: [tag]
      })
    });

    if (!tagResponse.ok) {
      const errorText = await tagResponse.text();
      console.warn('GHL Step 2 Tag Warning:', errorText);
    }

    // ==========================================
    // STAP 3: Opportunity aanmaken in de pijplijn
    // ==========================================
    const opportunityResponse = await fetch('https://services.leadconnectorhq.com/opportunities/', {
      method: 'POST',
      headers: ghlHeaders,
      body: JSON.stringify({
        locationId,
        name: `${name} — Website Lead`,
        pipelineId: 'TAoxuBj8L0molnqCvgB7',
        pipelineStageId: '242f8b1b-e497-4aa2-9bff-b052293b90f6',
        contactId,
        status: 'open'
      })
    });

    if (!opportunityResponse.ok) {
      const errorText = await opportunityResponse.text();
      console.warn('GHL Step 3 Opportunity Warning:', errorText);
    }

    // ==========================================
    // STAP 4: Bericht opslaan als notitie
    // ==========================================
    const labels = {
      starter: 'Ik wil een eerste huis kopen (starter)',
      verzekeringen: 'Verzekeringen',
      belastingaangifte: 'Belastingaangifte',
      overige: 'Anders / Overige'
    };
    const serviceTypeLabel = labels[serviceType] || serviceType;

    const noteResponse = await fetch(`https://services.leadconnectorhq.com/contacts/${contactId}/notes`, {
      method: 'POST',
      headers: ghlHeaders,
      body: JSON.stringify({
        body: `Bericht via website:\n\n${message || 'Geen bericht achtergelaten'}\n\nHulpvraag: ${serviceTypeLabel}`
      })
    });

    if (!noteResponse.ok) {
      const errorText = await noteResponse.text();
      console.warn('GHL Step 4 Note Warning:', errorText);
    }

    // Return success to the client
    return new Response(
      JSON.stringify({ success: true }),
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
