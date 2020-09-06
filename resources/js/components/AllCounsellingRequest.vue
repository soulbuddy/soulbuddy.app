<template>
    <div class="row list" v-infinite-scroll="loadRequests" infinite-scroll-throttle-delay="3000">
        <div class="col-md-4 list-item" v-for="(request, i) in requests" :key=i>
            <div class="card mt-4">
                <div class="card-header">
                    <p class="h1 mb-2">
                        <b-icon :icon="getRequestIcon(request.category)"></b-icon>
                        {{request.category.category}}
                    </p>
                </div>
                <div class="card-body">
                    <p class="card-text" @click="viewRequest(i)"><strong>{{ request.subject }}</strong> <br>
                        {{ truncateText(request.description, 0, 30) }}
                    </p>
                </div>
                <div class="card-footer">
                    <b-container class="">
                        <b-row class="align-items-center">
                            <b-col>
                                <span class="align-middle">
                                    <avatar v-bind:username="request.owner.name"></avatar>
                                    {{ request.owner.name }}</span>
                            </b-col>
                            <b-col>
                                {{ dateFormat(request.expiry_date) }}
                            </b-col>
                        </b-row>
                    </b-container>
                </div>
            </div>
        </div>
        <el-dialog v-if="currentRequest" :visible.sync="requestDialogVisible" width="40%">
            <div>
                <h3>
                    {{ currentRequest.subject }}
                </h3>
                <hr>
                <p>{{ currentRequest.description }}</p>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button type="primary" @click="requestDialogVisible = false">Close</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
    import {articleMixin} from "../helpers/articleMixin";
    import Avatar from "vue-avatar/src/Avatar";
    import moment from "moment";

    export default {
        components: {Avatar},
        mixins: [articleMixin],
        name: "all-counselling-request",
        data() {
            return {
                isLoading: false,
                requestDialogVisible: false,
                currentRequest: '',
                requests: [],
                numOfItems: 30,
                page: 1,
            };
        },
        beforeMount() {
            this.getRequests();
        },
        methods: {
            getRequestIcon(category) {
                let icon = 'question-circle-fill';
                switch (category.category) {
                    case 'Love':
                        icon = 'heart-fill';
                        break;
                    case 'Family':
                        icon = 'house-door-fill';
                        break;
                    case 'Career':
                        icon = 'briefcase-fill';
                        break;
                    case 'Mood':
                        icon = 'lightning-fill';
                        break;
                    case 'Friendship':
                        icon = 'people-fill';
                        break;
                    case 'Others':
                        icon = 'question-circle-fill';
                        break;
                    case 'School':
                        icon = 'book';
                        break;
                    default:
                        icon = 'question-circle-fill';
                        break;
                }
                console.log('icon = ', icon);
                return icon;
            },

            dateFormat(timestamp) {
                if (timestamp) {
                    return moment(String(timestamp)).format('MM/DD/YYYY')
                }
            },

            viewRequest(requestIndex) {
                this.currentRequest = this.requests[requestIndex];
                console.log(this.currentRequest);
                this.requestDialogVisible = true;
            },

            loadRequests() {
                this.page++;
                this.getRequests();
            },

            getRequests() {
                this.isLoading = true;
                axios.get('/counselling/get_paginated_request?page=' + this.page, {
                    params: {
                        numOfItems: this.numOfItems,
                    }
                })
                    .then(response => {
                        this.isLoading = false
                        if (this.requests.length == 0) {
                            this.requests = response.data.data;
                        } else this.requests = [].concat(this.requests, response.data.data);
                        console.log('Requests = ', response.data.data);
                    });
            }
        },
    }
</script>

<style scoped>
</style>
