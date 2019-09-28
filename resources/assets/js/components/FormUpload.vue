<template>
    <!--<form action="/" method="post" enctype="multipart/form-data">-->
    <form @submit.prevent="handleSubmit">
        <!--{{ csrf_field() }} Dùng axios, miễn trong template có thẻ meta csrf-token, trong app.js đã include nó vô header axios -->

        <div class="form-group">
            <label>Image</label>

            <file-input @file-change="setImages"
                        :images="images"
                        @clear-file="clearImages"
                        :isUploading="isUploading"></file-input>
            <!--<input type="file" class="" name="images[]" multiple>-->
        </div>

        <div class="form-group text-right">
            <button class="btn btn-success" type="submit" :disabled="disableUploadBtn">Upload</button>
        </div>

        <progress-bar :progress="progress" v-show="isUploading"></progress-bar>
    </form>
</template>

<script>
    import FileInput from './FileInput';
    import ProgressBar from './ProgressBar';

    export default {
        name: 'FormUpload',
        components: { FileInput, ProgressBar },
        data() {
            return {
                images: [],
                progress: 0,
                isUploading: false,
                disableUploadBtn: true
            };
        },
        methods: {
            async handleSubmit() {
                let formData = new FormData();

                Array.from(this.images).forEach(image => {
                    formData.append('images[]', image, image.name);
                });

                try {
                    this.isUploading = true;
                    this.disableUploadBtn = true;
                    const res = await axios.post(
                        '/api/images',
                        formData,
                        {
                            onUploadProgress: e => {
                                if (e.lengthComputable) {
                                    this.progress = Math.ceil(e.loaded / e.total * 100);
                                    console.log(this.progress)
                                }
                            }
                        }
                    );
                    console.log('Upload completed!');

                    setTimeout(() => this.isUploading = false, 1000);
                    this.images = []; // Reset
                } catch (err) {
                    console.log(err);
                    console.log('Upload Failed!');
                    this.isUploading = false;

                }
            },
            setImages(files) {
                this.images = files;
                this.disableUploadBtn = false;
            },
            clearImages() {
                this.images = [];
                this.disableUploadBtn = true;
            }
        }
    }
</script>

<style scoped></style>