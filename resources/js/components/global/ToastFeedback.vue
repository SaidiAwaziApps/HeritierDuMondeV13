<template>
    <div class="global-content">
        <!-- Toast Container -->
        <div id="toast_container" class="position-fixed p-3">
            <div id="feedback_toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">
                        {{ title ? title : 'Toast Feedback' }}
                    </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <!-- toast-body-content -->
                    <div class="toast-body-content">
                        <div class="success-message" style="text-align: center;" v-if="response">
                            <div v-if="response.data.errors">
                                <div v-for="key in response.data.errors">
                                    <span v-for="error in response.data.errors[key]">
                                        {{  error  }}<br>
                                    </span>     
                                </div>
                            </div>
                            <div v-if="!response.data.errors">
                                <span style="font-size: 18px;font-weight: bold;font-family: italic;opacity: 0.8;" :style="[response.data.success ? { color: 'green'  } : { color: 'red' }]">
                                    {{ response.data.message }} <i class="fa fa-check" style="padding: 4px;border-radius: 10px;background-color: green;color: white;opacity: 0.6;"></i> 
                                </span>   
                            </div>        
                        </div>
                        <div class="errors" v-if="error">
                            <div class="error-item" style="text-align: center;">
                                <span style="font-size: 18px;font-weight: bold;font-family: italic;color: red;">
                                    {{ error.response ? error.response.text : 'Echec de connection au serveur !!!' }}                         
                                </span>   
                            </div>
                        </div>
                    </div>
                    <!-- fin toast-body-content -->                       
                </div>
            </div>  
        </div> 
    </div>
</template>


<style scoped>
    div#toast_container {
        display: fixed;
        width: 360px;
        top: 8%;
        right: 0%;
        z-index: 11;
    }

    @media all and (max-width: 400px) {
        div#toast_container {
            width: 260px;
        }
    }

    div.toast-body {
        text-align: center;
    }

    div.toast-body-content > div.success-message > div > div,
    div.toast-body-content > div.success-message > div {
        text-align: center;
    }

    div.toast-body-content > div.success-message > div > div span,
    div.toast-body-content > div.success-message > div span {
        font-size: 18px;
        font-weight: bold;
        font-family: italic;
        opacity: 0.8;
    }

    div.toast-body-content > div.success-message > div > div span {
        color: red;
    }

    div.toast-body-content > div.success-message > div span {
        color: green;
    }

    div.toast-body-content > div.errors > .error-item {
        text-align: center;
    }

    div.toast-body-content > div.errors > .error-item span {
        font-size: 18px;
        font-weight: bold;
        font-family: italic;
        opacity: 0.8;
    }
</style>

<script>
import { Toast } from 'bootstrap'

export default {
    name: 'ToastFeedback',
    props: ['active','title','response','error'],

    data: function() {
        return {
            toastInstance: null
        }
    },

    watch: {
        active: function(value) {

            const el = document.getElementById('feedback_toast')

            if (!el) return

            // Bootstrap safe init (une seule instance)
            if (!this.toastInstance) {
                this.toastInstance = new Toast(el)
            }

            if (value) {
                this.toastInstance.show()

                setTimeout(() => {
                    this.toastInstance.hide()
                }, 8000)
            }
        }
    }
}
</script>