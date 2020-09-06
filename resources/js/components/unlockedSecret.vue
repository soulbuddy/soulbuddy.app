<template>
    <div class="outer">
        <div class="info">
            <div class="profile">
                <avatar v-bind:username="this.secret.author.name"></avatar>
                <span>{{ this.secret.author.name }}</span>
            </div>

        </div>
        <b-card :title="this.secret.title">
            <b-card-text> {{ truncateText(this.secret.description, 0, 100) }}</b-card-text>
            <b-card-footer class="description">
                <div>
                    created at {{ dateFormat(this.secret.created_at) }}
                </div>
            </b-card-footer>
        </b-card>
        <div>
            <b-button class="button" @click="handleSecret">
                <b-icon-unlock-fill variant="light"></b-icon-unlock-fill>
                <span>View Secret</span>
            </b-button>
        </div>
    </div>
</template>

<script>
    import Avatar from "vue-avatar/src/Avatar";
    import {articleMixin} from "../helpers/articleMixin";

    export default {
        name: "unlockedSecret",
        components: {Avatar},
        props: ['secret'],
        mixins: [articleMixin],
        methods: {
            handleSecret() {
                this.$emit('handleSecret', this.secret.id);
            },
        },
    }
</script>

<style scoped>
    .description {
        background: white;
        font-weight: 500;
        font-size: 14px;
    }

    .outer {
        border-radius: 10px;
        border: 1px solid #F63854
    }

    .profile {
        padding: 10px 20px;
        display: flex;
        align-items: center;
        font-weight: 800;
    }

    .profile span {
        padding-left: 10px;
    }

    .button {
        width: 100%;
        border-radius: 0 0 10px 10px;
        background-color: #5B995B;
        font-weight: 500;

    }
</style>
