<template>
    <div class="flex">
        <el-radio-group v-model="isCollapse" style="margin-bottom: 20px;">
            <el-radio-button :label="false">expand</el-radio-button>
            <el-radio-button :label="true">collapse</el-radio-button>
        </el-radio-group>
        <el-menu default-active="2" class="el-menu-vertical-demo" @select="handleSelect"
                 :collapse="isCollapse">
            <el-menu-item index="1">
                <i class="el-icon-menu"></i>
                <span slot="title">Articles</span>
            </el-menu-item>
            <el-menu-item index="2" disabled>
                <i class="el-icon-document"></i>
                <span slot="title">Tokens</span>
            </el-menu-item>
            <el-menu-item index="3">
                <i class="el-icon-setting"></i>
                <span slot="title">New Articles</span>
            </el-menu-item>
        </el-menu>
    </div>
</template>

<script>
    import {VueRouter as router} from "vue-router";

    export default {
        name: "Sidebar",
        data() {
            return {
                isCollapse: true,
                route: ['/home/articles', '/home/articles/new', '/home/top_up'],
            }
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key);
                this.$router.push({path: '/'});
            }

        }
    }
</script>

<style scoped>
    .el-menu-vertical-demo:not(.el-menu--collapse) {
        width: 200px;
        min-height: 400px;
    }
</style>
