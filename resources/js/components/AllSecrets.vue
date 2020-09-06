<template>
    <div class="row list" v-infinite-scroll="loadSecrets" infinite-scroll-throttle-delay="3000">
        <div class="col-md-12 list-item" v-for="(secret, i) in secrets" :key=i>
            <component :is="secretComponent(secret.id)" v-bind="{secret: secret}"
                       v-on:handleSecret="handleSecret"></component>
        </div>
        <el-dialog v-if="currentSecret" :visible.sync="secretDialogVisible" width="70%">
            <div>
                <h3>
                    {{ currentSecret[0].title }}
                </h3>
                <hr>
                <p>{{ currentSecret[0].body }}</p>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button type="primary" @click="secretDialogVisible = false">Close</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
    import LockedSecret from "./lockedSecret";

    export default {
        components: {LockedSecret},
        name: "all-secrets",
        data() {
            return {
                secrets: [],
                secretDialogVisible: false,
                isLoading: false,
                currentSecret: '',
                numOfItems: 30,
                page: 1,
            };
        },
        beforeMount() {
            this.getSecrets();
        },
        methods: {
            secretComponent(secretId) {
                return this.$store.state.userUnlockedSecrets.includes(secretId) ? 'unlocked-secret' : 'locked-secret';
            },
            viewSecret(secretId) {
                this.currentSecret = this.secrets.filter(secret => {
                    return secret.id == secretId;
                });
                this.secretDialogVisible = true;
            },

            loadSecrets() {
                this.page++;
                this.getSecrets();
            },

            handleSecret(secretId) {
                if (this.$store.state.userUnlockedSecrets.includes(secretId)) {
                    this.viewSecret(secretId)
                }
                let formData = new FormData();
                formData.append('secret_id', secretId);
                axios.post('/secret/unlock_secret', formData, {
                    headers: {"Content-Type": "multipart/form-data"}
                })
                    .then(res => {
                        if (res.status == '200') {
                            this.$store.dispatch('updateUserUnlockedSecrets', secretId);
                        }
                    })
            },

            getSecrets() {
                this.isLoading = true;
                axios.get('/secret/get_paginated_secrets?page=' + this.page, {
                    params: {
                        numOfItems: this.numOfItems,
                    }
                })
                    .then(response => {
                        this.isLoading = false
                        if (this.secrets.length == 0) {
                            this.secrets = response.data.data.data;
                        } else this.secrets = [].concat(this.secrets, response.data.data.data);
                    });
            }
        },
    }
</script>

<style scoped>
    .info {

    }

    .description {

    }

    .profile {
        display: flex;
    }
</style>
