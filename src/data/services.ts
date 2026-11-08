/**
 * src/data/services.ts
 * Single Source of Truth voor adviespijlers en diensten van Spekadvies Moerkapelle.
 */

export interface Pillar {
  id: 'hypotheken' | 'verzekeringen' | 'belastingaangifte' | 'vermogen';
  title: string;
  badge: string;
  slug: string;
  hubUrl: string;
  anchor: string;
  icon: string;
  description: string;
  leadText: string;
}

export interface ServiceItem {
  id: string;
  slug: string;
  pillarId: 'hypotheken' | 'verzekeringen' | 'belastingaangifte' | 'vermogen';
  title: string;
  shortDesc: string;
  url: string;
  icon: string;
  highlights: string[];
  isHubPage?: boolean;
}

export const PILLARS: Pillar[] = [
  {
    id: 'hypotheken',
    title: 'Hypotheken',
    badge: 'Pijler: Hypotheken',
    slug: 'hypotheken',
    hubUrl: '/hypotheken/',
    anchor: 'hypotheken',
    icon: 'fa-solid fa-house-chimney',
    description: 'Onafhankelijk hypotheekadvies met vergelijking van 40+ geldverstrekkers voor de laagste rente en beste voorwaarden.',
    leadText: 'Of je nu je eerste woning koopt, doorstroomt, je hypotheek wilt oversluiten of als ondernemer leent: wij berekenen exact jouw mogelijkheden.'
  },
  {
    id: 'verzekeringen',
    title: 'Verzekeringen',
    badge: 'Pijler: Verzekeringen',
    slug: 'verzekeringen',
    hubUrl: '/verzekeringen/',
    anchor: 'verzekeringen',
    icon: 'fa-solid fa-shield-halved',
    description: 'Bescherming voor je gezin, bezit, inkomen en bedrijf met garantie tegen onderverzekering en scherpe combikorting.',
    leadText: 'Geen gaten in dekkingen en geen overlap. Wij selecteren de beste voorwaarden voor particulieren en ondernemers.'
  },
  {
    id: 'belastingaangifte',
    title: 'Belastingaangifte',
    badge: 'Pijler: Belastingaangifte',
    slug: 'aangiften',
    hubUrl: '/aangiften/',
    anchor: 'belastingaangifte',
    icon: 'fa-solid fa-file-invoice-dollar',
    description: 'Zorgeloze belastingaangifte voor particulieren en ondernemers. Wij benutten elke fiscale aftrekpost optimaal.',
    leadText: 'Van hypotheekrenteaftrek tot complexe zakelijke aangiften: voorkom fouten en haal het maximale uit je teruggave.'
  },
  {
    id: 'vermogen',
    title: 'Vermogen & Pensioen',
    badge: 'Pijler: Vermogen & Pensioen',
    slug: 'vermogensbeheer',
    hubUrl: '/diensten/vermogensbeheer/',
    anchor: 'vermogen',
    icon: 'fa-solid fa-chart-line',
    description: 'Bouw verstandig aan vermogensgroei, een solide buffer en een zorgeloos pensioen met onafhankelijk advies.',
    leadText: 'Objectieve selectie van AFM-gereguleerde partijen zonder verborgen provisies, afgestemd op jouw persoonlijke risicoprofiel.'
  }
];

export const SERVICES_DATA: ServiceItem[] = [
  // --- HYPOTHEKEN (8) ---
  {
    id: 'startershypotheek',
    slug: 'startershypotheek',
    pillarId: 'hypotheken',
    title: 'Startershypotheek',
    shortDesc: 'Maximale leenruimte, benutting van de SVn Starterslening en 0% overdrachtsbelasting voor jouw allereerste koopwoning.',
    url: '/diensten/startershypotheek/',
    icon: 'fa-solid fa-key',
    highlights: ['40+ Banken', 'SVn Starterslening', '0% Overdrachtsbelasting']
  },
  {
    id: 'doorstromers-overbrugging',
    slug: 'doorstromers-overbrugging',
    pillarId: 'hypotheken',
    title: 'Doorstromers & Overbrugging',
    shortDesc: 'Overwaarde soepel voorfinancieren, dubbele maandlasten overbruggen en je huidige gunstige rente meenemen.',
    url: '/diensten/doorstromers-overbrugging/',
    icon: 'fa-solid fa-route',
    highlights: ['Overwaarde verzilveren', 'Rente meeneemregeling', 'Overbruggingskrediet']
  },
  {
    id: 'hypotheek-oversluiten',
    slug: 'hypotheek-oversluiten',
    pillarId: 'hypotheken',
    title: 'Hypotheek Oversluiten',
    shortDesc: 'Boeterente nauwkeurig berekenen, rentevaste periode aanpassen en structureel besparen op maandlasten.',
    url: '/diensten/hypotheek-oversluiten/',
    icon: 'fa-solid fa-rotate',
    highlights: ['Boeteberekening', 'Lagere maandlasten', 'Voorwaarden vergelijken']
  },
  {
    id: 'overwaarde-verzilveren',
    slug: 'overwaarde-verzilveren',
    pillarId: 'hypotheken',
    title: 'Overwaarde & Senioren',
    shortDesc: 'Opeethypotheek, rente bijschrijven en vermogen uit de stenen halen voor extra leefruimte, verbouwing of schenking.',
    url: '/diensten/overwaarde-verzilveren/',
    icon: 'fa-solid fa-coins',
    highlights: ['Opeethypotheek', 'Verzilverhypotheek', 'Fiscaal schenken']
  },
  {
    id: 'zzp-ondernemers-hypotheek',
    slug: 'zzp-ondernemers-hypotheek',
    pillarId: 'hypotheken',
    title: 'ZZP & Ondernemers',
    shortDesc: 'Hypotheektoetsing op basis van jaarcijfers al vanaf 1 jaar zelfstandig ondernemerschap via de Inkomensverklaring.',
    url: '/diensten/zzp-ondernemers-hypotheek/',
    icon: 'fa-solid fa-briefcase',
    highlights: ['Vanaf 1 jaar cijfers', 'Inkomensverklaring', 'Zakelijk & privé']
  },
  {
    id: 'nieuwbouw-hypotheek',
    slug: 'nieuwbouw-hypotheek',
    pillarId: 'hypotheken',
    title: 'Nieuwbouw Hypotheek',
    shortDesc: 'Bouwdepot deskundig geregeld, renteverlies tijdens de bouw opvangen en extra leenruimte voor energiezuinige woningen.',
    url: '/diensten/nieuwbouw-hypotheek/',
    icon: 'fa-solid fa-trowel-bricks',
    highlights: ['Bouwdepot advies', 'Extra A++++ leenruimte', 'Renteverlies opvangen']
  },
  {
    id: 'hypotheek-verduurzamen',
    slug: 'hypotheek-verduurzamen',
    pillarId: 'hypotheken',
    title: 'Hypotheek Verduurzamen',
    shortDesc: 'Energiebespaarbudget (EBB), Energiebesparende Voorzieningen (EBV) en aantrekkelijke rentekorting tot wel 0,20%.',
    url: '/diensten/hypotheek-verduurzamen/',
    icon: 'fa-solid fa-leaf',
    highlights: ['Tot €20.000 extra leenruimte', 'Duurzaamheidskorting', 'Lagere energierekening']
  },
  {
    id: 'hypotheek-bij-scheiding',
    slug: 'hypotheek-bij-scheiding',
    pillarId: 'hypotheken',
    title: 'Hypotheek bij Scheiding',
    shortDesc: 'Partner uitkopen, ontslag uit hoofdelijke aansprakelijkheid en snelle financiële rust voor beide partijen.',
    url: '/diensten/hypotheek-bij-scheiding/',
    icon: 'fa-solid fa-handshake-simple',
    highlights: ['Partner uitkopen', 'Ontslag aansprakelijkheid', 'Heldere verdeling']
  },

  // --- VERZEKERINGEN (4) ---
  {
    id: 'woonverzekeringen',
    slug: 'woonverzekeringen',
    pillarId: 'verzekeringen',
    title: 'Woonverzekeringen',
    shortDesc: 'Complete opstal- en inboedelbescherming met garantie tegen onderverzekering en aantrekkelijke combikorting.',
    url: '/diensten/woonverzekeringen/',
    icon: 'fa-solid fa-house-shield',
    highlights: ['Garantie onderverzekering', 'Opstal & Inboedel', '10% Pakketkorting']
  },
  {
    id: 'overlijdensrisicoverzekering',
    slug: 'overlijdensrisicoverzekering',
    pillarId: 'verzekeringen',
    title: 'Overlijdensrisico (ORV)',
    shortDesc: 'Financiële bescherming voor je nabestaanden, zodat jouw partner of gezin veilig in de woning kan blijven wonen.',
    url: '/diensten/overlijdensrisicoverzekering/',
    icon: 'fa-solid fa-shield-heart',
    highlights: ['Gelijkblijvend of lineair', 'Scherpste premie', 'Koppeling hypotheek']
  },
  {
    id: 'aov-zzp-verzekering',
    slug: 'aov-zzp-verzekering',
    pillarId: 'verzekeringen',
    title: 'AOV voor Ondernemers',
    shortDesc: 'Arbeidsongeschiktheidsverzekering voor zelfstandigen en dga\'s met fiscaal aftrekbare premie en soepele dekking.',
    url: '/diensten/aov-zzp-verzekering/',
    icon: 'fa-solid fa-user-shield',
    highlights: ['Fiscaal aftrekbaar', 'Beroepsarbeidsongeschikt', 'Maatwerk wachttijd']
  },
  {
    id: 'zakelijke-verzekeringen',
    slug: 'zakelijke-verzekeringen',
    pillarId: 'verzekeringen',
    title: 'Zakelijke Verzekeringen',
    shortDesc: 'Bedrijfsaansprakelijkheid (AVB), beroepsaansprakelijkheid en inventaris/goederenverzekering voor ondernemers.',
    url: '/diensten/zakelijke-verzekeringen/',
    icon: 'fa-solid fa-building-shield',
    highlights: ['AVB & Beroepsaansprakelijkheid', 'Inventaris & goederen', 'Bedrijfsschade']
  },

  // --- BELASTINGAANGIFTE (2) ---
  {
    id: 'aangifte-particulier',
    slug: 'aangifte-particulier',
    pillarId: 'belastingaangifte',
    title: 'Particuliere Belastingaangifte',
    shortDesc: 'Aangifte inkomstenbelasting optimaal ingevuld met benutting van alle fiscale aftrekposten en toeslagen.',
    url: '/aangiften/',
    icon: 'fa-solid fa-file-invoice-dollar',
    highlights: ['Maximale teruggave', 'Fiscaal partnerschap verdelen', 'Check toeslagen']
  },
  {
    id: 'aangifte-zakelijk',
    slug: 'aangifte-zakelijk',
    pillarId: 'belastingaangifte',
    title: 'Zakelijke Belastingaangiften',
    shortDesc: 'Winst uit onderneming, zelfstandigenaftrek, MKB-winstvrijstelling en periodieke omzetbelasting (BTW) voor zzp\'ers.',
    url: '/aangiften/',
    icon: 'fa-solid fa-calculator',
    highlights: ['Winst uit onderneming', 'Zelfstandigenaftrek', 'Kwartaalaangifte BTW']
  },

  // --- VERMOGEN & PENSIOEN (2) ---
  {
    id: 'vermogensbeheer-advies',
    slug: 'vermogensbeheer-advies',
    pillarId: 'vermogen',
    title: 'Vermogensbeheer & Beleggen',
    shortDesc: 'Onafhankelijk advies over vermogensopbouw, risicospreiding en selectie van betrouwbare partijen zonder provisies.',
    url: '/diensten/vermogensbeheer/',
    icon: 'fa-solid fa-chart-line',
    highlights: ['Gecontroleerde groei', 'Geen verborgen commissies', 'Passend risicoprofiel']
  },
  {
    id: 'pensioen-lijfrente',
    slug: 'pensioen-lijfrente',
    pillarId: 'vermogen',
    title: 'Pensioenadvies & Lijfrente',
    shortDesc: 'Pensioengat in kaart brengen, jaarruimte fiscaal benutten via lijfrente en financieel vangnet voor later opbouwen.',
    url: '/diensten/vermogensbeheer/',
    icon: 'fa-solid fa-piggy-bank',
    highlights: ['Jaarruimte benutten', 'Box 1 aftrek', 'Pensioengat dichten']
  }
];

// Helper functies
export function getPillarById(id: string): Pillar | undefined {
  return PILLARS.find(p => p.id === id);
}

export function getServicesByPillar(pillarId: string): ServiceItem[] {
  return SERVICES_DATA.filter(s => s.pillarId === pillarId);
}

export function getAllPillarsWithServices() {
  return PILLARS.map(pillar => ({
    ...pillar,
    services: getServicesByPillar(pillar.id)
  }));
}
