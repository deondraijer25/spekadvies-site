<?php
/**
 * Spekadvies Lead Connector - GoHighLevel Contact API Handler
 * Handles form submissions from ContactForm.astro and ContactDrawer.astro
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
    // STAP 1: Contact Upsert
    // -------------------------------------------------------------
    $upsertPayload = [
        'firstName'  => $firstName,
        'lastName'   => $lastName,
        'phone'      => $phone,
        'email'      => $email,
        'locationId' => $locationId
    ];

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
        // STAP 2: Tag toevoegen
        // -------------------------------------------------------------
        ghlApiRequest(
            "https://services.leadconnectorhq.com/contacts/{$contactId}/tags",
            'POST',
            ['tags' => [$tag]],
            $apiKey
        );

        // -------------------------------------------------------------
        // STAP 3: Opportunity in Pijplijn aanmaken
        // -------------------------------------------------------------
        $oppPayload = [
            'locationId'      => $locationId,
            'name'            => "{$name} — Website Lead ({$serviceLabel})",
            'pipelineId'      => $pipelineId,
            'pipelineStageId' => $pipelineStageId,
            'contactId'       => $contactId,
            'status'          => 'open'
        ];

        ghlApiRequest(
            'https://services.leadconnectorhq.com/opportunities/',
            'POST',
            $oppPayload,
            $apiKey
        );

        // -------------------------------------------------------------
        // STAP 4: Notitie toevoegen
        // -------------------------------------------------------------
        $noteBody = "Nieuwe aanvraag via spekadvies.nl:\n\n" .
                    "Naam: {$name}\n" .
                    "Telefoon: {$phone}\n" .
                    "E-mail: {$email}\n" .
                    "Hulpvraag: {$serviceLabel}\n" .
                    "Datum: " . date('d-m-Y H:i:s') . "\n\n" .
                    "Toelichting van bezoeker:\n" .
                    (!empty($message) ? $message : 'Geen toelichting ingevuld.');

        ghlApiRequest(
            "https://services.leadconnectorhq.com/contacts/{$contactId}/notes",
            'POST',
            ['body' => $noteBody],
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
$subject = "Nieuwe aanvraag via website: {$name} ({$serviceLabel})";
$emailHeaders = "From: Spekadvies Website <noreply@spekadvies.nl>\r\n" .
                "Reply-To: {$name} <{$email}>\r\n" .
                "X-Mailer: PHP/" . phpversion() . "\r\n" .
                "Content-Type: text/plain; charset=UTF-8\r\n";

$emailBody = "Er is een nieuwe aanvraag binnengekomen via het contactformulier op www.spekadvies.nl:\n\n" .
             "--------------------------------------------------\n" .
             "Naam:        {$name}\n" .
             "Telefoon:    {$phone}\n" .
             "E-mail:      {$email}\n" .
             "Dienst:      {$serviceLabel}\n" .
             "Tijdstip:    " . date('d-m-Y H:i') . "\n" .
             "--------------------------------------------------\n\n" .
             "Bericht / Wensen:\n" .
             (!empty($message) ? $message : 'Geen bericht ingevuld.') . "\n\n" .
             "--------------------------------------------------\n" .
             "GHL Status:  " . ($ghlSuccess ? "Succesvol geregistreerd in GoHighLevel (ID: {$contactId})" : "Let op: GHL registratie mislukt of vertraagd") . "\n";

@mail($to, $subject, $emailBody, $emailHeaders);

// Return response to browser
http_response_code(200);
echo json_encode([
    'success'   => true,
    'message'   => 'Aanvraag succesvol verwerkt.',
    'contactId' => $contactId
]);
