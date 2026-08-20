document.addEventListener('alpine:init', () => {
    Alpine.data('signaturePad', () => ({
        isDrawing: false,
        context: null,
        signatureData: '',

        init() {
            // Get the 2D context of the canvas to draw paths
            this.context = this.$refs.canvas.getContext('2d');
            this.context.lineWidth = 2;
            this.context.lineCap = 'round';
            this.context.strokeStyle = '#000'; // Black ink
        },

        // Get exact coordinates accounting for canvas offset and scrolling
        getCoordinates(event) {
            const rect = this.$refs.canvas.getBoundingClientRect();
            const clientX = event.touches ? event.touches[0].clientX : event.clientX;
            const clientY = event.touches ? event.touches[0].clientY : event.clientY;
            return {
                x: clientX - rect.left,
                y: clientY - rect.top
            };
        },

        startDrawing(event) {
            this.isDrawing = true;
            const { x, y } = this.getCoordinates(event);
            this.context.beginPath();
            this.context.moveTo(x, y);
        },

        draw(event) {
            if (!this.isDrawing) return;
            const { x, y } = this.getCoordinates(event);
            this.context.lineTo(x, y);
            this.context.stroke();
        },

        stopDrawing() {
            this.isDrawing = false;
        },

        clear() {
            // Wipe the canvas clean
            this.context.clearRect(0, 0, this.$refs.canvas.width, this.$refs.canvas.height);
            this.signatureData = '';
            this.$wire.set('renter_signature', '');
        },

        saveSignature() {
            // Convert the canvas to a base64 PNG string
            this.signatureData = this.$refs.canvas.toDataURL('image/png');

            // Sync the base64 string to the Livewire component property before submit
            this.$wire.set('renter_signature', this.signatureData);
        }
    }));
});
