import { z, defineCollection } from 'astro:content';
import { glob } from 'astro/loaders';

// Generic schema for SEO programmatic subservices & location pages
const seoPageSchema = z.object({
  name: z.string(), // E.g. "Startershypotheek", "Moerkapelle"
  seoTitle: z.string(),
  seoDescription: z.string(),
  heroTitle: z.string(),
  heroSubtitle: z.string(),
  ctaText: z.string().default("Gratis adviesgesprek inplannen"),
  category: z.enum(['hypotheken', 'verzekeringen', 'locaties']).default('hypotheken'),
  
  // Key selling points / USPs
  usps: z.array(z.object({
    icon: z.string().optional(),
    title: z.string(),
    description: z.string()
  })).optional(),

  // Bento Stats & Metric Cards
  statsBento: z.array(z.object({
    stat: z.string(),
    label: z.string(),
    detail: z.string()
  })).optional(),

  // Structured Comparison Table
  comparisonTable: z.object({
    title: z.string(),
    description: z.string().optional(),
    headers: z.array(z.string()),
    rows: z.array(z.array(z.string()))
  }).optional(),

  // E-E-A-T Expert Tips from Martin van der Spek
  expertTips: z.array(z.object({
    title: z.string(),
    tip: z.string()
  })).optional(),
  
  // Pain points / Problems addressed
  problemsTitle: z.string().optional(),
  problems: z.array(z.object({
    icon: z.string().optional(),
    title: z.string(),
    description: z.string()
  })).optional(),

  // Social Proof & Local Review Quote
  reviewQuote: z.object({
    quote: z.string(),
    author: z.string(),
    context: z.string(),
    rating: z.number().default(5)
  }).optional(),

  // FAQs at the bottom of the page (with Schema.org FAQPage sync)
  faqItems: z.array(z.object({
    question: z.string(),
    answer: z.string()
  })).optional(),
  
  // Extra text sections for deep indexation (e.g. background info, tips)
  articleBlocks: z.array(z.object({
    title: z.string(),
    body: z.string()
  })).optional()
});

export const collections = {
  'locaties': defineCollection({
    loader: glob({ pattern: "**/*.md", base: "./src/content/locaties" }),
    schema: seoPageSchema,
  }),
  'diensten': defineCollection({
    loader: glob({ pattern: "**/*.md", base: "./src/content/diensten" }),
    schema: seoPageSchema,
  })
};

export type SeoPageData = z.infer<typeof seoPageSchema>;
