<template>
  <div class="form-group">
    <label :for="name"><slot></slot></label>
    <input type="text" class="form-control" :id="name" value :name="name" :placeholder="placeholder" />
  </div>
</template>
<script>
export default {
    props : ['name','placeholder']
};
</script>