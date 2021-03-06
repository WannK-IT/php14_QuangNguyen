<?php $url = URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'value_new');?>
<div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
    <div class="mb-1">
        <select id="bulk-action" name="bulk-action" class="custom-select custom-select-sm mr-1" style="width: unset">
            <option value="" selected="">Bulk Action</option>
            <option value="delete">Multi Delete</option>
            <option value="active">Multi Active</option>
            <option value="inactive">Multi Inactive</option>
        </select>
        <button id="bulk-apply" class="btn btn-sm bg-gradient-info" data-url="<?= $url ?>">Apply <span class="badge badge-pill badge-danger navbar-badge" style="display: none"></span></button>
    </div>
    <a href="<?= URL::createLink($this->arrParam['module'], $this->arrParam['controller'], 'form', ['task' => 'add']) ?>" class="btn btn-sm bg-gradient-info"><i class="fas fa-plus"></i> Add New</a>
</div>
