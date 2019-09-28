<template>
    <div class="progress">
        <div class="progress-bar progress-bar-info progress-bar-striped"
             role="progressbar"
             :style="{ width: progressPercent }">
            {{ progress < 100 ? progressPercent : 'Upload Completed!' }}
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ProgressBar',
        props: {
            progress: { type: Number, default: 0 }
        },
        data() {
            return {

            };
        },
        computed: {
            progressPercent() {
                return this.progress + '%';
            }
        }
    }
</script>

<style scoped></style>