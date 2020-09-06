<template>
    <div class="main">
        <div class="header">{{ article.title }}</div>
        <div class="info-container">
            <div class="d-flex profile-inline">
                <avatar v-bind:username="this.article.author.name"></avatar>
                <div class="infos">
                    <div class="name">{{ article.author.name }}</div>
                    <div>{{ dateFormat(article.created_at) }}</div>
                </div>
            </div>
        </div>
        <div class="body">
            <p> {{ truncateText(article.body, 0, 300) }}</p>
        </div>
        <button @click="$emit('viewArticle')">Read more</button>
        <div class="footer">
            <customized-star-rating :object="article" :type="article"></customized-star-rating>
        </div>
    </div>
</template>

<script>
    import {articleMixin} from "../helpers/articleMixin";
    import Avatar from "vue-avatar/src/Avatar";

    export default {
        name: "ArticleListingBase",
        props: ['article'],
        mixins: [articleMixin],
        components: {Avatar}
    }
</script>

<style scoped>
    .footer {
        border-bottom: 1px solid #d8d8d8;
        max-width: 50rem;
        margin-bottom: 50px;
    }

    .main {
        box-shadow: 5px 5px rgb(0, 0, 0, 0.06);

    }

    button {
        border: none;
        text-align: left;
        font-size: 13px;
        color: #6c757d;
        padding: 20px;
    }

    button:hover {
        color: #F63854;
        font-weight: bold;
        margin-left: auto;
    }

    .body {
        padding: 20px;
        max-width: 50rem;
        font-family: Arvo, SansSerif, Sana;
        color: #2a2a2a;
    }

    .header {
        border-left: 3px solid #F63854;
        padding-left: 10px;
        font-weight: 500;
        font-family: Arvo, serif;
        font-size: 32px;
    }

    .infos {
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 10px;
        font-size: 12px;
        font-family: Arvo, serif;
        font-weight: 700;
        color: #6c757d;
    }

    .info-container {
    }

    .profile-inline {
        padding: 20px;
    }
</style>
