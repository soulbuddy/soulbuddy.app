<template>
    <div class="card mt-4" :key="componentKey">
        <div class="card-body">
            <div
                v-if="status_msg"
                :class="{ 'alert-success': status, 'alert-danger': !status }"
                class="alert"
                role="alert"
            >{{ status_msg }}</div>
            <form>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input
                        v-model="title"
                        type="text"
                        class="form-control"
                        id="title"
                        placeholder="Article Title"
                        required
                    />
                </div>
                <div class="form-group">
                    <label for="article-content">Article Content</label>
                    <textarea v-model="body" class="form-control" id="article-content" rows="3" required></textarea>
                </div>
                <div class>
                    <el-upload
                        action="#"
                        list-type="picture-card"
                        :on-preview="handlePictureCardPreview"
                        :on-change="updateImageList"
                        :auto-upload="false"
                    >
                        <i class="el-icon-plus"></i>
                    </el-upload>
                    <el-dialog :visible.sync="dialogVisible">
                        <img width="100%" :src="dialogImageUrl" alt />
                    </el-dialog>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <button
                type="button"
                @click="createArticle"
                class="btn btn-success"
            >{{ isCreatingArticle ? "Posting..." : "Create Article" }}</button>
        </div>
    </div>
</template>

<style>
    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .avatar-uploader .el-upload:hover {
        border-color: #409eff;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
    }
    .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }
</style>

<script>
    import { setTimeout } from "timers";
    import { mapState, mapActions } from "vuex";
    export default {
        name: "create-article",
        props: ["articles"],
        data() {
            return {
                dialogImageUrl: "",
                dialogVisible: false,
                imageList: [],
                status_msg: "",
                status: "",
                isCreatingArticle: false,
                title: "",
                body: "",
                componentKey: 0
            };
        },
        computed: {},
        mounted() {},
        methods: {
            updateImageList(file) {
                this.imageList.push(file.raw);
            },
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.url;
                this.imageList.push(file);
                this.dialogVisible = true;
            },
            createArticle(e) {
                e.preventDefault();
                if (!this.validateForm()) {
                    return false;
                }
                const that = this;
                this.isCreatingArticle = true;
                let formData = new FormData();
                formData.append("title", this.title);
                formData.append("body", this.body);
                $.each(this.imageList, function(key, image) {
                    formData.append(`images[${key}]`, image);
                });
                this.$emit('onSubmit', formData);
            },
            validateForm() {
                //no vaildation for images - it is needed
                if (!this.title) {
                    this.status = false;
                    this.showNotification("Article title cannot be empty");
                    return false;
                }
                if (!this.body) {
                    this.status = false;
                    this.showNotification("Article body cannot be empty");
                    return false;
                }
                return true;
            },
            showNotification(message) {
                this.status_msg = message;
                setTimeout(() => {
                    this.status_msg = "";
                }, 3000);
            }
        }
    };
</script>
