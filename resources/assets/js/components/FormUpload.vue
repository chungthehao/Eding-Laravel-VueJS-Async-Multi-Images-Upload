<template>
    <!--<form action="/" method="post" enctype="multipart/form-data">-->
    <form @submit.prevent="handleSubmit">
        <!--{{ csrf_field() }} Dùng axios, miễn trong template có thẻ meta csrf-token, trong app.js đã include nó vô header axios -->

        <div class="form-group">
            <label>Image</label>

            <file-input @file-change="setImage"></file-input>
            <!--<input type="file" class="" name="images[]" multiple>-->
        </div>

        <div class="form-group text-right">
            <button class="btn btn-success" type="submit">Upload</button>
        </div>

        <progress-bar :progress="progress"></progress-bar>
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
                progress: 0
            };
        },
        methods: {
            handleSubmit() {
                let formData = new FormData();

                Array.from(this.images).forEach(image => {
                    formData.append('images[]', image, image.name);
                });

                axios
                    .post(
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
                    )
                    .then(res => console.log('Upload completed!'))
                    .catch(err => console.log('Upload failed!'));

                this.images = []; // Reset
            },
            setImage(files) {
                this.images = files; // 2 biến object cùng trỏ tới 1 memory
            }
        }
    }
</script>

<style scoped></style>