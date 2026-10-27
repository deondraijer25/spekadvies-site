<?php
/**
 * Spekadvies Lead Connector - GoHighLevel Contact API Handler
 * Handles form submissions from /adviesgesprek interactive funnel
 * Compatible with Apache/Nginx DirectAdmin hosting
 */

// Set response headers
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed. Use POST.']);
    exit;
}

// Read raw JSON body
$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

// Fallback to $_POST if multipart form-data was sent
if (!$data || !is_array($data)) {
    $data = $_POST;
}

$name = isset($data['name']) ? trim($data['name']) : '';
$phone = isset($data['phone']) ? trim($data['phone']) : '';
$email = isset($data['email']) ? trim($data['email']) : '';
$city = isset($data['city']) ? trim($data['city']) : '';
$situation = isset($data['situation']) ? trim($data['situation']) : '';
$timeline = isset($data['timeline']) ? trim($data['timeline']) : '';
$preference = isset($data['preference']) ? trim($data['preference']) : '';
$serviceType = isset($data['service-type']) ? trim($data['service-type']) : (isset($data['serviceType']) ? trim($data['serviceType']) : 'overig');
$message = isset($data['message']) ? trim($data['message']) : '';

// Validation
if (empty($name) || empty($phone) || empty($email)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Vul alle verplichte velden in (naam, telefoon, e-mail).']);
    exit;
}

// Credentials for GoHighLevel
$apiKey = 'pit-1300b7d5-1086-49aa-a077-6369e44465b0';
$locationId = 'nGSkiNF1QBLT7slHOGPW';
$pipelineId = 'TAoxuBj8L0molnqCvgB7';
$pipelineStageId = '242f8b1b-e497-4aa2-9bff-b052293b90f6';

// Parse name
$nameParts = preg_split('/\s+/', $name, 2);
$firstName = isset($nameParts[0]) ? $nameParts[0] : $name;
$lastName = isset($nameParts[1]) ? $nameParts[1] : '';

// Map service type to readable label and GHL tag
$tagMap = [
    'hypotheken'        => 'hypotheken',
    'starter'           => 'hypotheken',
    'verzekeringen'     => 'verzekeringen',
    'aangifte'          => 'belastingaangifte',
    'belastingaangifte' => 'belastingaangifte',
    'vermogen'          => 'vermogen',
    'vermogensbeheer'   => 'vermogen',
    'overig'            => 'overige',
    'overige'           => 'overige'
];
$tag = isset($tagMap[$serviceType]) ? $tagMap[$serviceType] : 'overige';

$labelMap = [
    'hypotheken'        => 'Hypotheekadvies',
    'starter'           => 'Startershypotheek',
    'verzekeringen'     => 'Verzekeringen',
    'aangifte'          => 'Belastingaangifte',
    'belastingaangifte' => 'Belastingaangifte',
    'vermogen'          => 'Vermogen & Pensioen',
    'vermogensbeheer'   => 'Vermogen & Pensioen',
    'overig'            => 'Overige / Anders'
];
$serviceLabel = isset($labelMap[$serviceType]) ? $labelMap[$serviceType] : ucfirst($serviceType);

$cleanSituation = !empty($situation) ? $situation : 'Niet opgegeven';
$cleanTimeline = !empty($timeline) ? $timeline : 'Niet opgegeven';
$cleanPreference = !empty($preference) ? $preference : 'Niet opgegeven';
$cleanMessage = !empty($message) ? $message : 'Geen extra toelichting ingevuld.';

// Helper function for GHL cURL requests
function ghlApiRequest($url, $method = 'POST', $payload = null, $apiKey = '') {
    $ch = curl_init($url);
    $headers = [
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json',
        'Version: 2021-07-28'
    ];
    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

    if ($payload !== null) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    return [
        'status' => $httpCode,
        'body'   => $response ? json_decode($response, true) : null,
        'raw'    => $response,
        'error'  => $curlError
    ];
}

$ghlSuccess = false;
$contactId = null;

try {
    // -------------------------------------------------------------
    // STAP 1: Contact Upsert (incl. Woonplaats, Bron & 5 Custom Fields)
    // -------------------------------------------------------------
    $upsertPayload = [
        'firstName'    => $firstName,
        'lastName'     => $lastName,
        'phone'        => $phone,
        'email'        => $email,
        'locationId'   => $locationId,
        'source'       => 'Website Keuzehulp (spekadvies.nl)',
        'customFields' => [
            ['id' => 'JUxucX44sWJqWD4BhkX0', 'field_value' => $serviceLabel],
            ['id' => 'lxVrsr6WZXDuIBVsprNk', 'field_value' => $cleanSituation],
            ['id' => 'uUNpxnkKv71DWF07nwAg', 'field_value' => $cleanTimeline],
            ['id' => 'zSC7vH2DoQkB399Dk4LX', 'field_value' => $cleanPreference],
            ['id' => 'PN1vRTOEby0Z2trJTu9U', 'field_value' => $cleanMessage]
        ]
    ];
    if (!empty($city)) {
        $upsertPayload['city'] = $city;
    }

    $upsertRes = ghlApiRequest(
        'https://services.leadconnectorhq.com/contacts/upsert',
        'POST',
        $upsertPayload,
        $apiKey
    );

    if ($upsertRes['status'] >= 200 && $upsertRes['status'] < 300 && isset($upsertRes['body']['contact']['id'])) {
        $contactId = $upsertRes['body']['contact']['id'];
        $ghlSuccess = true;

        // -------------------------------------------------------------
        // STAP 2: Gestructureerde 5-Staps Notitie toevoegen in GHL
        // -------------------------------------------------------------
        $noteBody = "📋 NIEUWE AFSPRAAK-AANVRAAG VIA SPEKADVIES.NL\n" .
                    "==================================================\n" .
                    "1. Onderwerp:         {$serviceLabel}\n" .
                    "2. Gekozen situatie:  {$cleanSituation}\n" .
                    "3. Gewenste termijn:  {$cleanTimeline}\n" .
                    "4. Voorkeur afspraak: {$cleanPreference}\n" .
                    "==================================================\n" .
                    "CONTACTGEGEVENS:\n" .
                    "• Naam:       {$name}\n" .
                    "• Telefoon:   {$phone}\n" .
                    "• E-mail:     {$email}\n" .
                    "• Woonplaats: " . (!empty($city) ? $city : 'Niet ingevuld') . "\n" .
                    "• Datum/tijd: " . date('d-m-Y H:i:s') . "\n\n" .
                    "EXTRA TOELICHTING VAN BEZOEKER:\n" .
                    $cleanMessage;

        ghlApiRequest(
            "https://services.leadconnectorhq.com/contacts/{$contactId}/notes",
            'POST',
            ['body' => $noteBody],
            $apiKey
        );

        // -------------------------------------------------------------
        // STAP 3: Slimme Tags toevoegen (incl. 'website-lead')
        // -------------------------------------------------------------
        if (isset($upsertRes['body']['contact']['tags']) && is_array($upsertRes['body']['contact']['tags']) && in_array('website-lead', $upsertRes['body']['contact']['tags'])) {
            ghlApiRequest(
                "https://services.leadconnectorhq.com/contacts/{$contactId}/tags",
                'DELETE',
                ['tags' => ['website-lead']],
                $apiKey
            );
        }

        $tagsToApply = ['website-lead', $tag];

        if (!empty($preference)) {
            $prefLower = strtolower($preference);
            if (strpos($prefLower, 'kantoor') !== false) {
                $tagsToApply[] = 'afspraak-kantoor';
            } elseif (strpos($prefLower, 'thuis') !== false) {
                $tagsToApply[] = 'afspraak-thuis';
            } elseif (strpos($prefLower, 'telefonisch') !== false) {
                $tagsToApply[] = 'afspraak-telefonisch';
            }
        }

        if (!empty($timeline)) {
            $timeLower = strtolower($timeline);
            if (strpos($timeLower, 'snel') !== false) {
                $tagsToApply[] = 'termijn-zsm';
            } elseif (strpos($timeLower, 'maanden') !== false) {
                $tagsToApply[] = 'termijn-1-3-maanden';
            } elseif (strpos($timeLower, 'ori') !== false) {
                $tagsToApply[] = 'termijn-orienterend';
            }
        }

        ghlApiRequest(
            "https://services.leadconnectorhq.com/contacts/{$contactId}/tags",
            'POST',
            ['tags' => array_values(array_unique($tagsToApply))],
            $apiKey
        );

        // -------------------------------------------------------------
        // STAP 4: Opportunity in Pijplijn aanmaken of updaten (incl. gekozen Situatie)
        // -------------------------------------------------------------
        $oppTitle = !empty($situation)
            ? "{$name} — {$serviceLabel}: {$situation}"
            : "{$name} — Website Lead ({$serviceLabel})";

        $oppPayload = [
            'locationId'      => $locationId,
            'name'            => $oppTitle,
            'pipelineId'      => $pipelineId,
            'pipelineStageId' => $pipelineStageId,
            'contactId'       => $contactId,
            'status'          => 'open'
        ];

        ghlApiRequest(
            'https://services.leadconnectorhq.com/opportunities/upsert',
            'POST',
            $oppPayload,
            $apiKey
        );

        // -------------------------------------------------------------
        // STAP 5: Directe Workflow Trigger ("Nieuwe website lead")
        // -------------------------------------------------------------
        ghlApiRequest(
            "https://services.leadconnectorhq.com/contacts/{$contactId}/workflow/4487dcf1-e769-4a58-bf73-07bb80455f89",
            'POST',
            new stdClass(),
            $apiKey
        );
    }
} catch (Exception $e) {
    error_log("GHL Exception: " . $e->getMessage());
}

// -----------------------------------------------------------------
// E-MAIL BACKUP (Gegarandeerde levering naar Martin / Spekadvies)
// -----------------------------------------------------------------
$to = 'info@spekadvies.nl';
$subject = "Nieuwe afspraak-aanvraag: {$name} ({$serviceLabel}" . (!empty($situation) ? " - {$situation}" : "") . ")";
$emailHeaders = "From: Spekadvies Website <noreply@spekadvies.nl>\r\n" .
                "Reply-To: {$name} <{$email}>\r\n" .
                "X-Mailer: PHP/" . phpversion() . "\r\n" .
                "Content-Type: text/plain; charset=UTF-8\r\n";

$emailBody = "Er is een nieuwe afspraak-aanvraag binnengekomen via de interactieve keuzehulp op www.spekadvies.nl:\n\n" .
             "==================================================\n" .
             "GEKOZEN STAPPEN IN DE KEUZEHULP:\n" .
             "==================================================\n" .
             "1. Onderwerp:         {$serviceLabel}\n" .
             "2. Situatie:          {$cleanSituation}\n" .
             "3. Gewenste termijn:  {$cleanTimeline}\n" .
             "4. Voorkeur afspraak: {$cleanPreference}\n\n" .
             "==================================================\n" .
             "CONTACTGEGEVENS:\n" .
             "==================================================\n" .
             "Naam:        {$name}\n" .
             "Telefoon:    {$phone}\n" .
             "E-mail:      {$email}\n" .
             "Woonplaats:  " . (!empty($city) ? $city : 'Niet ingevuld') . "\n" .
             "Tijdstip:    " . date('d-m-Y H:i') . "\n\n" .
             "Extra toelichting:\n" .
             $cleanMessage . "\n\n" .
             "--------------------------------------------------\n" .
             "GHL Status:  " . ($ghlSuccess ? "Succesvol geregistreerd in GoHighLevel (Contact ID: {$contactId})" : "Let op: GHL registratie mislukt of vertraagd") . "\n";

@mail($to, $subject, $emailBody, $emailHeaders);

// Return response to browser
http_response_code(200);
echo json_encode([
    'success'   => true,
    'message'   => 'Aanvraag succesvol verwerkt.',
    'contactId' => $contactId
]);
