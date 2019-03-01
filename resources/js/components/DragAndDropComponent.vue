<template>
  <div class="field">
    <vue-dropzone @vdropzone-success="setFileID" @vdropzone-removed-file="deleteFile" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
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
        setFileID(file, response) {

          this.id = response.id

        },

        deleteFile (event) {
          axios.delete(`${this.url}/${this.id}`).then((res) => {
            console.log(res)
          })
        }
      },
    }
</script>
