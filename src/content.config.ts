import { z, defineCollection } from 'astro:content';
import { glob } from 'astro/loaders';

// Generic schema for SEO programmatic pages
const seoPageSchema = z.object({
  name: z.string(), // E.g. "Moerkapelle", "Startershypotheek"
  seoTitle: z.string(),
  seoDescription: z.string(),
  heroTitle: z.string(),
  heroSubtitle: z.string(),
  ctaText: z.string().default("Gratis adviesgesprek inplannen"),
  
  // Key selling points / USPs
  usps: z.array(z.object({
    icon: z.string().optional(),
    title: z.string(),
    description: z.string()
  })).optional(),
  
  // Pain points / Problems addressed
  problemsTitle: z.string().optional(),
  problems: z.array(z.object({
    icon: z.string().optional(),
    title: z.string(),
    description: z.string()
  })).optional(),

  // FAQs at the bottom of the page
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
