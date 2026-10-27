# Spekadvies Officiële Styling Guide & Typografie Standaard

Dit document legt de **enige geldende standaard** vast voor typografie (lettertypes, groottes, gewichten, regelhoogtes), knoppen, badges, kleuren en containers over de gehele Spekadvies website.

---

## 1. Kernregels (Invariants)

1. **Maximaal Semi-Bold (`font-weight: 600`):** Over de gehele website wordt **nooit** `font-weight: 700` (`font-bold`), `800` of `900` gebruikt. Het zwaarste gewicht is altijd `600` (`font-semibold`).
2. **Standaard Paginabreedte (`max-w-7xl`):** Alle hoofdcontainers gebruiken `max-w-7xl mx-auto px-4 sm:px-8 lg:px-12` (`1280px`).
3. **Twee Lettertypes (`Unbounded` & `Poppins`):**
   - **`Unbounded` (`var(--font-display)`):** Uitsluitend voor **`H1`**, **`H2`**, **`H3`** en grote **statistiek-getallen** (`.ty-stat`).
   - **`Poppins` (`var(--font-sans)`):** Voor **`H4`** (subkoppen, USP-titels, FAQ-vragen, footer-titels), **paragrafen**, **eyebrow-labels**, **navigatie**, **formulieren** en **buttons**.
4. **Geen SCHREEUWENDE hoofdletters op knoppen:** Knoppen gebruiken normale schrijfwijze (*Sentence case*, bijv. `"Plan gratis kennismaking"`). Alleen kleine eyebrow-labels boven titels (`.ty-eyebrow`) zijn `UPPERCASE` (`12px`, `tracking-widest`).

---

## 2. Typografie Schaal (`H1` t/m Paragrafen)

Omdat **Unbounded** een breed display-lettertype is, oogt `32px` in Unbounded even groot en krachtig als `42px–44px` in een standaard schreefloos lettertype. De onderstaande schaal zorgt ervoor dat de `H1` in de Hero altijd de grootste kop op de pagina is en dat sectietitels (`H2`) en kaarttitels (`H3`) daar rustig onder vallen.

| Onderdeel | CSS Class / Tag | Font Family & Weight | Mobiel (`<640px`) | Tablet (`640px+`) | Desktop (`1024px+`) | `line-height` | `letter-spacing` |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| **Hoofdtitel (`H1`)** | `h1`, `.ty-h1` | `Unbounded` (`600`) | **`24px`** (`1.5rem`) | **`28px`** (`1.75rem`) | **`32px`** (`2.0rem`) | `1.24` | `-0.025em` |
| **Sectietitel (`H2`)** | `h2`, `.ty-h2` | `Unbounded` (`600`) | **`21px`** (`1.3125rem`) | **`24px`** (`1.5rem`) | **`28px`** (`1.75rem`) | `1.26` | `-0.02em` |
| **Kaarttitel (`H3`)** | `h3`, `.ty-h3` | `Unbounded` (`600`) | **`18px`** (`1.125rem`) | **`19px`** (`1.1875rem`) | **`21px`** (`1.3125rem`) | `1.28` | `-0.015em` |
| **Subkop / USP / FAQ (`H4`)** | `h4`, `.ty-h4` | `Poppins` (`600`) | **`15px`** (`0.9375rem`) | **`16px`** (`1rem`) | **`16px`** (`1rem`) | `1.40` | `0em` |
| **Eyebrow / Sectie-label** | `.ty-eyebrow` | `Poppins` (`600`) | **`11px`** (`0.6875rem`) | **`12px`** (`0.75rem`) | **`12px`** (`0.75rem`) | `1.40` | `0.10em` (`uppercase`) |
| **Paragraaf Intro / Lead** | `.ty-lead` | `Poppins` (`400`) | **`15px`** (`0.9375rem`) | **`16px`** (`1rem`) | **`16px`** (`1rem`) | `1.65` | `0em` |
| **Paragraaf Kaart / Body** | `.ty-body` | `Poppins` (`400`) | **`14px`** (`0.875rem`) | **`14px`** (`0.875rem`) | **`14px`** (`0.875rem`) | `1.60` | `0em` |
| **Bijschrift / Meta** | `.ty-small` | `Poppins` (`400`/`500`) | **`12px`** (`0.75rem`) | **`12px`** (`0.75rem`) | **`12px`** (`0.75rem`) | `1.45` | `0em` |
| **Statistiek Getal** | `.ty-stat` | `Unbounded` (`600`) | **`24px`** (`1.5rem`) | **`28px`** (`1.75rem`) | **`30px`** (`1.875rem`) | `1.15` | `-0.02em` |

---

## 3. Buttons & Interactieve Links

| Onderdeel | CSS Class | Font & Weight | Font-Size | Padding & Vorm | Stijl & Toepassing |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Primary Button (Donkerblauw)** | `.btn-primary` | `Poppins` (`600`) | **`15px`** (`0.9375rem`) | `px-7 py-3.5` (`rounded-full`) | Spekadvies blauw (`#153b68`) met witte tekst en rond pijl-icoontje (`w-7 h-7`). Standaard hoofdknop op witte/lichte secties. |
| **Primary Button (Goud op Donker)** | `.btn-primary-gold` | `Poppins` (`600`) | **`15px`** (`0.9375rem`) | `px-7 py-3.5` (`rounded-full`) | Spekadvies goud (`#ffce76`) met donkerblauwe tekst (`#153b68`). Standaard hoofdknop op donkerblauwe secties/formulieren. |
| **Secondary Button (Licht)** | `.btn-secondary` | `Poppins` (`600`) | **`15px`** (`0.9375rem`) | `px-6 py-3.5` (`rounded-full`) | Lichtgrijs/wit (`bg-slate-100`) met donkerblauwe tekst (`#153b68`) en rand (`border-slate-200/80`). |
| **Navbar Button** | `.btn-nav` | `Poppins` (`600`) | **`13px`** (`0.8125rem`) | `px-5 py-2.5` (`rounded-full`) | Compacte pil-knop voor in de header (`Plan Gesprek`, `Polski`). |
| **Kaart Actielink** | `.link-action` | `Poppins` (`600`) | **`14px`** (`0.875rem`) | `p-0` (inline met `→`) | Actielink onderin kaarten (*"Bekijk startershypotheek →"*). |

---

## 4. Kleurenpalet

- **Spekadvies Diepblauw (`--color-brand-dark`):** `#153b68` (Hoofdkleur voor `H1`–`H4`, primaire knoppen, iconen, footer en accent-kaarten)
- **Spekadvies Goud/Oranje (`--color-brand-primary` / `--color-brand-accent`):** `#ffce76` (Hover: `#e9ba64`)
- **Eyebrow Tekstkleur op Wit (`text-amber-700`):** `#b45309` (Hoog contrast op lichte achtergrond conform WCAG AA/AAA)
- **Eyebrow Tekstkleur op Donkerblauw (`text-brand-primary`):** `#ffce76`
- **Broodtekst op Wit (`text-slate-600`):** `#475569`
- **Broodtekst op Donkerblauw (`text-slate-200` / `text-slate-300`):** `#e2e8f0` / `#cbd5e1`
- **Sectie-achtergronden:** `#ffffff` (Wit) afgewisseld met `#f8fafc` (`bg-brand-basetint`) of `#eef2f6`.
