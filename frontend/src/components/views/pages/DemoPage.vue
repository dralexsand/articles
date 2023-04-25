<template>
  <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
    <p class="text-3xl text-gray-700 font-bold mb-5">
      Demo page
    </p>

    <div class="grid grid-cols-1 gap-6">

      <ui-input :form="dataFormInput" onchange="handleUiInput()"/>

      <ui-select :form="dataFormSelect"/>

      <ui-check-box :form="dataFormCheckBox"/>

      <ui-radio :form="dataFormRadio"/>

    </div>

  </div>
</template>
<script>
import uiSelect from "../../ui/uiSelect.vue";
import uiInput from "../../ui/uiInput.vue";
import uiCheckBox from "../../ui/uiCheckBox.vue";
import uiRadio from "../../ui/uiRadio.vue";
import {ref} from "vue";

export default {

  components: {
    uiSelect, uiInput, uiCheckBox, uiRadio
  },

  setup() {

    const dataFormInput = ref({
      name: "main_input",
      class: "mt-1 block w-full rounded-md border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 bg-gray-100",
      label: "Input form label",
      placeholder: "Input form placeholder",
    });

    const dataFormSelect = ref({
      name: "main_select",
      class: "mt-1 block w-full rounded-md border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 bg-gray-100",
      label: "Select form label. What type of event is it?",
      options: [
        {
          value: "0",
          label: "Choice event",
        },
        {
          value: "wedding",
          label: "Wedding",
        },
        {
          value: "birthday",
          label: "Birthday",
        },
        {
          value: "other",
          label: "Other",
        },
      ],
    });

    const dataFormCheckBox = ref({
      name: "main_checkbox",
      class: "w-5 h-5 border border-gray-300 rounded-sm outline-none cursor-pointer",
      label: "CheckBox form label. Select Gender",
    });

    const dataFormRadio = ref({
      name: "main_radio",
      classTitle: "inline-block mb-4 text-sm text-gray-600",
      labelTitle: "Radio form title. Select color",
      classItemWrapper: "flex items-center mb-3 last:mb-0",
      classItem: "w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer",
      classLabelItem: "ml-2 text-sm",
      items: [
        {
          value: "cyan",
          label: "Cyan",
        },
        {
          value: "red",
          label: "Red",
        },
        {
          value: "orange",
          label: "Orange",
        },
      ],
    });

    const handleUiInput = (item) => {
      console.log(item);
    }

    return {
      dataFormInput,
      dataFormSelect,
      dataFormCheckBox,
      dataFormRadio,
      handleUiInput,
    }
  }
}
</script>