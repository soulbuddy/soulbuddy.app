<template>
    <div>
        <!--<b-overlay no-center show rounded="sm" opacity="0.0">
            <template v-slot:overlay>
                <b-icon
                    icon="lock"
                    variant="danger"
                    scale="2"
                    class="position-absolute"
                    style="top: 0; right: 0"
                ></b-icon>
            </template>-->
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
                    <span>Unlock Secret</span>
                </b-button>
            </div>
        </div>
        <!--</b-overlay>-->
    </div>
</template>

<script>
    import {articleMixin} from "../helpers/articleMixin";
    import Avatar from "vue-avatar/src/Avatar";

    export default {
        name: "lockedSecret",
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
    /*.inner {
        display: table-cell;
    }

    .child {
        display: table-column;
    }*/

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
        background-color: #F63854;
        font-weight: 500;
        border-color: #F63854;

    }
</style>
