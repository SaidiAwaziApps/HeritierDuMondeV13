<template>
    <div class="toast-container" ref="toastContainer">
        <!-- Toast Bootstrap -->
        <div class="toast toast-upload" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Chargement</strong>
                <small>{{ loadedPercent }}%</small>
            </div>

            <div class="toast-body">
                <div class="progress-bar">
                    <div class="progress" :style="{ width: loadedPercent + '%' }"></div>
                </div>
            </div>

            <div class="toast-footer">
                <span>{{ progress?.loaded?.file || '' }}</span>
            </div>
        </div>
    </div>
</template>


<style scoped>
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 250px;
        z-index: 9999;
    }

    .toast-upload {
        background: #fff;
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 8px;
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    .toast-header {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .progress-bar {
        width: 100%;
        height: 6px;
        background: #eee;
        border-radius: 3px;
    }

    .progress {
        height: 100%;
        background: green;
        width: 0%;
        border-radius: 3px;
        transition: width 0.3s;
    }

    .toast-footer {
        text-align: center;
    }

    .toast-footer span {
        font-size: 16px;
        font-style: italic;
    }
</style>


<script>
    import { Toast } from "bootstrap";

    export default {
        name: "UploadProgressToastComponent",
        props: ["progress"],

        computed: {
            // Calcul automatique du pourcentage de progression
            loadedPercent: function() {
                if (!this.progress || !this.progress.totalSize) return 0;
                return Math.round((this.progress.loaded.size * 100) / this.progress.totalSize);
            }
        },

        watch: {
            // Affiche le toast automatiquement dès qu'il y a un progrès
            progress: function(newVal) {
                if (newVal) this.showToast();
                else this.hideToast();
            }
        },

        methods: {
            showToast: function() {
                const toastEl = this.$refs.toastContainer.querySelector(".toast");
                if (!toastEl) return;

                let bsToast = Toast.getInstance(toastEl);
                if (!bsToast) {
                    bsToast = new Toast(toastEl, { autohide: false });
                }
                bsToast.show();
            },

            hideToast: function() {
                const toastEl = this.$refs.toastContainer.querySelector(".toast");
                if (!toastEl) return;

                const bsToast = Toast.getInstance(toastEl);
                if (bsToast) bsToast.hide();
            }
        }
};
</script>