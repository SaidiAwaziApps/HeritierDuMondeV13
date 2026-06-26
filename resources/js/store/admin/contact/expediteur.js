import { defineStore } from "pinia";

const useExpediteurStore = defineStore('expediteur', {
    state: () => ({
        current: null,
        items: []
    }),
    actions: {
        setCurrent(expediteur) {
            this.current = expediteur;
        },
        setItems(expediteurs) {
            this.items = expediteurs;
        }
    }
});

export default useExpediteurStore;