<template>
    <div>
        <div class="wrapper-center">
            <div>
                <slot name="bannerHeader"></slot>
            </div>
            <div>
                <slot name="bannerDescription"></slot>
            </div>
        </div>

        <div class="tools">
            <slot name="tools"></slot>
        </div>

        <slot name="content"></slot>
    </div>
</template>

<script>
    export default {
        name: "pageTemplate",
    }
</script>

<style scoped>
    .wrapper-center {
        width: 100%;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
    }
</style>
