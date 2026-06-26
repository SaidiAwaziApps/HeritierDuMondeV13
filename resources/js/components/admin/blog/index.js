import { createApp } from "vue";

import CommentHub from "./commentaire/CommentHub.vue";

const app=createApp({});

app.component('comment-hub',CommentHub);

app.mount('#comment_hub')