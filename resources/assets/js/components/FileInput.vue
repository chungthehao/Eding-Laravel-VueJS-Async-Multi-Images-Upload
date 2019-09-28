<template>
    <div>
        <div class="input-group">
            <input type="text" class="form-control" :value="nameList"
                   placeholder="Choose your image" readonly>

            <span class="input-group-btn">
                <button v-if="images.length && !isUploading" class="btn btn-default" type="button" @click="clearFiles">
                    <i class="glyphicon glyphicon-ban-circle text-danger"></i>
                </button>

                <button class="btn btn-default" type="button" @click="showFilePicker" :disabled="isUploading">
                    <i class="glyphicon glyphicon-paperclip"></i>
                </button>
            </span>
        </div>

        <input type="file" ref="imageRef" style="display: none;" @change="onChangeFile" multiple>
    </div>
</template>

<script>
    export default {
        name: 'FileInput',
        props: ['images', 'isUploading'],
        computed: {
            nameList() {
                // * Chuyển FileList obj (half an array) ---> a real array
                // dùng Array.from(this.images)
                return Array.from(this.images).map(image => image.name).join(', ');
            }
        },
        methods: {
            showFilePicker() {
                this.$refs.imageRef.click();
            },
            onChangeFile($event) {
                this.$emit('file-change', $event.target.files);
            },
            clearFiles() {
                this.$emit('clear-file');
            }
        }
    }
</script>

<style scoped></style>