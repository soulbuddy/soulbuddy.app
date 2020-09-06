<template>
    <b-container fluid class="text-center">
        <b-row align-h="between">
            <b-col align-self="center" cols="auto">
                <div class="row" style="align-items: center;">
                    <img :src="image_src" width="140" height="28" alt="Missing Pic"/>
                </div>
            </b-col>
            <b-col cols="auto" align-self="center">
                <el-menu
                    :default-active="activeIndex"
                    mode="horizontal"
                    @select="handleSelect"
                >
                    <el-menu-item index="2">About</el-menu-item>
                    <el-menu-item index="3">Services</el-menu-item>
                    <el-menu-item index="4">Contact</el-menu-item>
                    <el-menu-item v-if="isLoggedIn" index="5">Logout</el-menu-item>
                    <el-menu-item v-else index="5">Login</el-menu-item>
                </el-menu>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    export default {
        data() {
            return {
                windowSize: {
                    x: 0,
                    y: 0,
                },
                activeIndex: "1",
                image_src: 'images/logo.png',
            }
        },
        computed: {
            isLoggedIn() {
                return this.$store.getters.isLoggedIn;
            }
        },
        mounted() {
            console.log('user Id = ', this.$userId);
            this.$store.commit('setAuthUser', this.$userId);
            this.onResize();
        },
        methods: {
            onResize() {
                this.windowSize = {x: window.innerWidth, y: window.innerHeight}
            },
        }
    }
</script>

<style scoped>
    div {
        background-color: #fff;
    }

    img {
        display: block;
        max-width: 140px;
        max-height: 28px;
        width: auto;
        height: auto;
    }

    .el-menu-item {
        background-color: #FFF;
    }


    .el-menu-item:hover {
        background-color: #fff;
        color: #F63854 !important;

    }

    .el-menu--horizontal >>> .el-menu-item.is-active {
        border-bottom: 2px solid #F63854;
    }

    .el-menu--horizontal >>> .el-submenu .el-submenu__title:hover {
        outline: 0 !important;
        color: #F63854 !important;
        background: none !important;
    }

    .el-menu--horizontal >>> .el-submenu.is-active .el-submenu__title {
        color: #F63854 !important;
        border-bottom: 2px solid #F63854;
    }

</style>
