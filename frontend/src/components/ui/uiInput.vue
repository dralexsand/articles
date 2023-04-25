<template>

  <label class="block">
    <span class="text-gray-700">
      {{ form.label }}
    </span>
    <input
        type="text"
        :name="form.name"
        :class="form.class"
        :placeholder="form.placeholder"
        v-model="formValue"
        @change="onChange(formValue)"
    >

  </label>

</template>
<script>

import {ref} from "vue";

export default {
  props: {
    form: {
      class: {},
      label: {},
      placeholder: {},
      name: {},
    }
  },
  emits: [
    'handleUiInput'
  ],
  setup(props, {emit}) {
    const formValue = ref('');

    const onChange = (item) => {
      emit('handleUiInput', {
        name: this.form.name,
        value: {item: item.value}
      })
    }

    return {
      formValue,
      onChange
    }

  }
}
</script>