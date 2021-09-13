let Posts = {

    taContent: null,
    fileInput: null,
    photoInfos: {},
    $form: null,

    init: function(params){
        if(params) {
            this.photoInfos = params.photoInfos;
        }
        this.taContent = document.querySelector("#content");
        this.fileInput = document.querySelector('.dropzone');
        this.$form = document.querySelector('form');
        this.bindCKEditor();
        this.bindDropZone();
    },

    bindCKEditor: function (){
        ClassicEditor.create(this.taContent);
    },

    bindDropZone: function (){
        Dropzone.autoDiscover = false;

        let uploadUrl = this.fileInput.getAttribute('data-upload-url');

        let self = this;

        let deleteUrl = this.fileInput.getAttribute('data-delete-url');

        console.log(deleteUrl);

        let csrf = $('meta[name="csrf-token"]').attr('content');

        let dropZone = new Dropzone(this.fileInput,{
            url:uploadUrl,
            headers:{
                'x-csrf-token':csrf
            },
            maxFiles:1,
            acceptedFiles: 'image/jpeg,image/png',
            maxFilesize:3,
            addRemoveLinks: true,
            init: function (){
                if(Object.keys(self.photoInfos).length>0){
                    let mockFile = {
                        name:self.photoInfos.name,
                        size:self.photoInfos.size,
                        status: 'success'
                    };

                    this.emit("addedfile",mockFile);
                    this.emit("thumbnail",mockFile,self.photoInfos.path);
                    this.emit("complete",mockFile);

                    this.files.push(mockFile);

                    this.options.maxFiles = 1-this.files.length;
                }
            },
            maxfilesexceeded: function (file){
                this.removeFile(file);
            },
            success: function(file,xhr){
                $(`input[name='photo_path']`).val(xhr.path);
            },
            removedfile: function (file){

                let myDropZone = this;

                if(file.status && file.status !== 'error') {
                    $.ajax(deleteUrl, {
                        data: {
                            'path': $(`input[name='photo_path']`).val(),
                            'post_id': $(`input[name='post_id']`).val()
                        },
                        method: 'DELETE',
                        headers: {
                            'x-csrf-token': csrf
                        },
                        success: function (data) {
                            file.previewElement.remove();
                            myDropZone.options.maxFiles = 1;
                            $(`input[name='photo_path']`).val("");
                            if (data.success) {
                                toastr.success(data.message);
                            } else {
                                toastr.error(data.message)
                            }
                        }
                    });
                }else{
                    file.previewElement.remove();
                }
            }
        });
    }
};

window.Posts = Posts;
