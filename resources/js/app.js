import './signature-pad';

// Instructs Vite to bundle all images in the resources/images directory into the manifest
import.meta.glob([
    '../images/**',
], { eager: true });