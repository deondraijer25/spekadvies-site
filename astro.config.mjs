// @ts-check
import { defineConfig } from 'astro/config';
import tailwindcss from '@tailwindcss/vite';
import sitemap from '@astrojs/sitemap';
import vercel from '@astrojs/vercel';

// https://astro.build/config
export default defineConfig({
  site: 'https://www.spekadvies.nl',
  adapter: vercel(),
  integrations: [sitemap()],
  redirects: {
    '/contact': '/adviesgesprek',
    '/van-der-spek': '/over-ons',
    '/van-der-spek/medewerkers': '/over-ons',
    '/van-der-spek/contact': '/adviesgesprek',
    '/particulieren': '/hypotheken',
    '/particulieren/verzekeringen': '/verzekeringen',
    '/particulieren/hypotheken': '/hypotheken',
    '/particulieren/belastingen': '/aangiften',
    '/bedrijven': '/diensten/zakelijke-verzekeringen',
    '/zakelijk': '/diensten/zakelijke-verzekeringen',
    '/diensten-van-der-spek': '/',
    '/hypotheekadvies': '/hypotheken',
    '/pensioenadvies': '/diensten/vermogensbeheer',
    '/vermogensbeheer': '/diensten/vermogensbeheer',
    '/schade': '/klantenservice',
    '/schade-melden': '/klantenservice',
    '/downloads': '/klantenservice'
  },
  vite: {
    plugins: [tailwindcss()]
  }
});
