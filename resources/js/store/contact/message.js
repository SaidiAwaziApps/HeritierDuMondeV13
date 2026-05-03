import { defineStore } from "pinia";

const useMessageStore = defineStore('message', {
    state: () => ({
        current: null,
        items: []
    }),
    actions: {
        setCurrent(message) {
            this.current = message;
        },
        setItems(messages) {
            window.messages = messages;
            this.items = messages;
        }
    }
});

export default useMessageStore;
