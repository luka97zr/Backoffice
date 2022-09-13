export default {
    methods: {
        clearMessage(ms) {
            setTimeout(() => {
                this.success = false;
            }, ms);
        }
    },
}