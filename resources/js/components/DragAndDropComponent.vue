<template>
  <div class="field">
    <vue-dropzone  ref="dropzoneElement" @vdropzone-mounted="addFiles" @vdropzone-success="setFileID" @vdropzone-removed-file="deleteFile" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
  </div>
</template>

<script>

    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    import axios from 'axios'

    export default {
      props: {
        url: {
          required: true,
          type: String
        },
        uploads: {
          required: true,
          type: Array
        }
      },
     components: {
        vueDropzone: vue2Dropzone
      },
      data () {
        return {
          dropzoneOptions: {
            url: this.url,
            headers: {
              "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
            },
            addRemoveLinks: true,
          },
          id: null
        }
      },

      methods: {

        addFiles() {
              _.forEach(this.uploads, (upload) => {
                console.log(upload)
                this.$refs.dropzoneElement.manuallyAddFile({
                name: upload.filename,
                size: upload.size,
                type: "image/png"
              })
              })
        },
        setFileID(file, response) {

          this.id = response.id

        },

        deleteFile (file) {
          axios.delete(`${this.url}/${this.id}`).then((res) => {
           console.log(res)
          }).catch((err) => {
            this.$emit('vdropzone-file-added', {
              name: file.name,
              size: file.size,
              id: this.id
            })
          })
        }
      },
    }
</script>
