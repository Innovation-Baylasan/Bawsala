<modal name="cropImageModal"
       scrollable
       adaptive
       height="auto"
       v-cloak
       :click-To-Close="false">
    <image-cropper @cropped="setImage" :cropping="loading" :crop-ratio="cropRatio" :src="imageToCrop"/>
</modal>