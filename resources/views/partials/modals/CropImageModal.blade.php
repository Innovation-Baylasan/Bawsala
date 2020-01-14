<modal name="cropImageModal"
       height="auto"
       :click-To-Close="false">
    <image-cropper @cropped="setImage" :crop-ratio="cropRatio" :src="imageToCrop"/>
</modal>