<modal name="cropImageModal"
       scrollable
       height="auto"
       v-cloak
       :click-To-Close="false">
    <image-cropper @cropped="setImage" :cropping="loading" :crop-ratio="cropRatio" :src="imageToCrop"/>
</modal>