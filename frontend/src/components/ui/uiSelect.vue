<template>

  <label class="block">
    <span class="text-gray-700">
      {{ form.label }}
    </span>
    <select
        :name="form.name"
        :class="form.class">
      <option v-for="option in form.options" key="option.value">
        {{ option.label }}
      </option>
    </select>
  </label>

</template>
<script>

export default {
  props: {
    form: {
      class: {},
      label: {},
      options: [],
    }
  },
  setup() {

    return {}

  }
}
</script>