<template>
    <div>
        <div class="input-group">
            <input type="text" class="form-control" :value="image.name"
                   placeholder="Choose your image" readonly>

            <span class="input-group-btn">
                <button class="btn btn-default" type="button" @click="showFilePicker">
                    <i class="glyphicon glyphicon-paperclip"></i>
                </button>
            </span>
        </div>

        <input type="file" ref="imageRef" style="display: none;" @change="onChangeFile">
    </div>
</template>

<script>
    export default {
        name: 'FileInput',
        data() {
            return {
                image: {}
            };
        },
        methods: {
            showFilePicker() {
                this.$refs.imageRef.click();
            },
            onChangeFile($event) {
                this.image = $event.target.files[0];

                this.$emit('file-change', this.image);
            }
        }
    }
</script>

<style scoped></style>