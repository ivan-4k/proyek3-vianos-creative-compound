// import "../../css/pages/profile.css";
import "../../css/components/navigation.css";

// import "../plugins/aos-init";
import "../plugins/flowbite-init";

export default () => ({
    previewUrl: null,
    fileName: null,
    hapusAvatar: 0,

    handleFileSelect(event) {
        const file = event.target.files[0];

        if (file) {
            const validTypes = ["image/jpeg", "image/jpg", "image/png"];

            if (!validTypes.includes(file.type)) {
                alert("Format file harus JPEG, JPG, atau PNG");
                event.target.value = "";
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert("Ukuran file maksimal 2MB");
                event.target.value = "";
                return;
            }

            this.fileName = file.name;

            if (this.previewUrl) {
                URL.revokeObjectURL(this.previewUrl);
            }

            this.previewUrl = URL.createObjectURL(file);
            this.hapusAvatar = 0;
        }
    },
});
