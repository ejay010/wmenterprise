import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

// Expose Flatpickr globally to ensure Livewire and Alpine components can access it reliably
window.flatpickr = flatpickr;

import './signature-pad';

// Instructs Vite to bundle all images in the resources/images directory into the manifest
import.meta.glob([
    '../images/**',
], { eager: true });
