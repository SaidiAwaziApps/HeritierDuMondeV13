<template>
  <div>
    <button @click="showToast">Afficher Toast</button>
  </div>
</template>

<script>

import { toast } from 'vue3-toastify';

export default {
  name: 'ToastButton',
  methods: {
    showToast() {
      toast.success('✅ Le toast fonctionne !');
    }
  }
}
</script>
