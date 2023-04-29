<template>

  <label
      class="block">
    <span class="text-gray-700">
      {{ form.label }}
    </span>
    <input
        type="text"
        :name="form.name"
        :class="inputClass"
        placeholder=""
        v-model="formValueSearch"
        @change="onChange(formValueSearch, form.name)"
    >
  </label>

</template>
<script>

import {onMounted, ref} from "vue";
import {Select, initTE, Input, Datepicker} from "tw-elements";

export default {
  props: {
    form: {
      class: {},
      label: {},
      name: {},
    }
  },
  emits: [
    'handleUiCheckBox'
  ],
  setup(props, {emit}) {

    onMounted(() => {
      initTE({Select, Input, Datepicker});
    });

    const formValue = ref(false);
    const formValueSearch = ref('');

    const onChange = (value, name) => {
      emit('handleUiCheckBox', {
        name: name,
        value: value
      })
    }

    const thClass = ref('px-3 py-3');
    const tdClass = ref('px-3 py-3');
    const inputClass = ref('w-full h-8 border border-gray-300 rounded-sm outline-none cursor-pointer');

    return {
      tdClass,
      thClass,
      inputClass,
      formValue,
      formValueSearch,
      onChange,
    }

  }
}
</script>
<style scoped>
.block {
  padding: 5px;
}

.block input {
  padding-left: 2px;
}

.block span {

}


label {

}
</style>