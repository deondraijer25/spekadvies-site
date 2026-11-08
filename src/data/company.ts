/**
 * Officiële bedrijfs- en entiteitsgegevens Spekadvies Moerkapelle
 * Gebruikt voor Schema.org Structured Data (@graph), NAP-consistentie en E-E-A-T signalen.
 */
export const COMPANY_DATA = {
  name: 'Spekadvies',
  legalName: 'Van der Spek Advies B.V.',
  tradeName: 'Van der Spek Advies',
  alternateNames: [
    'Van der Spek Advies',
    'Van der Spek Advies B.V.',
    'Van der Spek Advies | Spekadvies',
    'Spek Advies B.V.'
  ],
  brandAnchor: 'Moerkapelle',
  googleBusiness: {
    profileName: 'Van der Spek Advies | Spekadvies',
    cid: '3230666344607343768',
    fid: '0x47c5ce480b60d47f:0x2cd5a1ec72216498',
    hasMap: 'https://www.google.com/maps/place//data=!4m2!3m1!1s0x47c5ce480b60d47f:0x2cd5a1ec72216498',
    ga4MeasurementId: 'G-6KB968ESWK',
    streamId: '16297479026'
  },
  founder: {
    name: 'Martin van der Spek',
    role: 'Erkend Hypothecair Planner & Onafhankelijk Financieel Adviseur',
    bio: 'Al meer dan 25 jaar het vertrouwde, onafhankelijke gezicht voor hypotheken, verzekeringen en financiële planning in Moerkapelle en omliggende gemeenten.',
    image: 'https://www.spekadvies.nl/assets/martin-van-der-spek.jpg',
    sameAs: [
      'https://www.linkedin.com/in/martinvanderspek',
      'https://www.advieskeuze.nl/advies/vd-spek-financiele-diensten'
    ]
  },
  address: {
    street: 'Herenweg 42',
    postalCode: '2751 DB',
    city: 'Moerkapelle',
    region: 'Zuid-Holland',
    country: 'NL',
    formatted: 'Herenweg 42, 2751 DB Moerkapelle'
  },
  geo: {
    latitude: 52.04983,
    longitude: 4.57526
  },
  contact: {
    phone: '079 593 1241',
    phoneRaw: '+31795931241',
    phoneDisplay: '079 - 593 12 41',
    email: 'info@spekadvies.nl',
    whatsapp: '+31795931241',
    website: 'https://www.spekadvies.nl'
  },
  accreditations: {
    kvk: '29051405',
    afm: '12009127',
    afmLabel: 'Vergunninghouder Autoriteit Financiële Markten (AFM: 12009127)',
    wft: 'Wft Hypothecair Krediet, Vermogen & Schadeverzekeringen',
    independent: '100% Onafhankelijk bemiddelaar via 40+ banken en geldverstrekkers'
  },
  openingHours: [
    { 
      days: ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag'], 
      hours: '09:00 - 17:30', 
      schemaDays: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'], 
      opens: '09:00', 
      closes: '17:30',
      isClosed: false
    },
    { 
      days: ['Zaterdag'], 
      hours: 'Op afspraak (09:00 - 13:00)', 
      schemaDays: ['Saturday'], 
      opens: '09:00', 
      closes: '13:00',
      isClosed: false
    },
    { 
      days: ['Zondag'], 
      hours: 'Gesloten', 
      schemaDays: [], 
      opens: null, 
      closes: null,
      isClosed: true
    }
  ],
  eveningAppointments: 'Avondgesprekken mogelijk op kantoor aan de Herenweg 42 of bij u thuis.',
  serviceAreas: [
    { name: 'Moerkapelle', isHeadquarters: true, postalCodes: ['2751'] },
    { name: 'Zevenhuizen', isHeadquarters: false, postalCodes: ['2761'] },
    { name: 'Waddinxveen', isHeadquarters: false, postalCodes: ['2741', '2742', '2743'] },
    { name: 'Gouda', isHeadquarters: false, postalCodes: ['2801', '2802', '2803', '2804', '2805', '2806', '2807', '2808', '2809'] },
    { name: 'Zoetermeer', isHeadquarters: false, postalCodes: ['2711', '2712', '2713', '2715', '2716', '2717', '2718', '2719', '2721', '2722', '2723', '2724', '2725', '2726', '2727', '2728', '2729'] },
    { name: 'Nieuwerkerk aan den IJssel', isHeadquarters: false, postalCodes: ['2911', '2912', '2913', '2914'] },
    { name: 'Moordrecht', isHeadquarters: false, postalCodes: ['2841'] },
    { name: 'Lansingerland', isHeadquarters: false, postalCodes: ['2651', '2652', '2661', '2662', '2665'] }
  ],
  /**
   * Klantbeoordelingen & Reviews per platform (TRUST_REVIEWS_VERIFIED).
   * Beide scores expliciet gescheiden met eigen schaal, aantal en verificatielink.
   */
  googleReviews: {
    platform: 'Google Reviews',
    label: 'Google Reviews',
    score: '4.9',
    maxScore: '5',
    worstScore: '1',
    scale: 5,
    ratingValue: 4.9,
    reviewCount: 47,
    count: 47,
    url: 'https://maps.google.com/?cid=3230666344607343768',
    writeReviewUrl: 'https://g.page/r/CdfgD9T6D_XpEAE/review'
  },
  advieskeuzeReviews: {
    platform: 'Advieskeuze.nl',
    label: 'Advieskeuze.nl',
    score: '9.4',
    maxScore: '10',
    worstScore: '1',
    scale: 10,
    ratingValue: 9.4,
    url: 'https://www.advieskeuze.nl/advies/vd-spek-financiele-diensten',
    verified: true
  },
  /**
   * @deprecated Behouden voor backwards compatibility met Schema.org in Layout.astro
   */
  rating: {
    score: '4.9',
    maxScore: '5.0',
    worstScore: '1',
    reviewCount: 47,
    platform: 'Google Reviews & Advieskeuze.nl'
  }
};

export const googleReviews = COMPANY_DATA.googleReviews;
export const advieskeuzeReviews = COMPANY_DATA.advieskeuzeReviews;

export interface ReviewPlatformData {
  platform: string;
  label: string;
  score: string;
  maxScore: string;
  worstScore?: string;
  scale: number;
  ratingValue: number;
  reviewCount?: number;
  count?: number;
  url: string;
  writeReviewUrl?: string;
  verified?: boolean;
}
