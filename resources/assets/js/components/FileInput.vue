<template>
    <div>
        <div class="input-group">
            <input type="text" class="form-control" :value="nameList"
                   placeholder="Choose your image" readonly>

            <span class="input-group-btn">
                <button class="btn btn-default" type="button" @click="showFilePicker">
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
        data() {
            return {
                images: [],
            };
        },
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
                this.images = $event.target.files;

                this.$emit('file-change', this.images);
            }
        }
    }
</script>

<style scoped></style>