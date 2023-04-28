<template>

  <label class="block">

    <div class="flex items-center w-1/3">
      <input
          type="checkbox"
          :name="form.name"
          :class="form.class"
          :checked="formValue"
          @change="onChange(formValue, form.name)"
      />
      <label class="ml-2 text-sm" for="email">
        {{ form.label }}
      </label>
    </div>

  </label>

</template>
<script>

import {ref} from "vue";

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

    const formValue = ref(false);

    const onChange = (value, name) => {
      emit('handleUiCheckBox', {
        name: name,
        value: value
      })
    }

    return {
      formValue,
      onChange,
    }

  }
}
</script>
<style scoped>
.block {
  padding: 5px;
}
</style>