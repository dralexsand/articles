<template>

  <label class="block">

    <div class="flex items-center w-1/3">
      <input
          type="checkbox"
          :name="form.name"
          :class="form.class"
          :checked="formValue"
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

    const onChange = () => {
      emit('handleUiCheckBox', {
        name: this.form.name,
        value: {item: formValue.value}
      })
    }

    return {
      formValue,
      onChange,
    }

  }
}
</script>