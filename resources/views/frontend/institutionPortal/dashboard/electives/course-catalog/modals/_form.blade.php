<form id="courseForm">
<div class="row g-4">

    <input type="hidden" name="elective_id" id="edit_id">

    <!-- Course Title -->
    <div class="col-md-6 floating-field">
        <input type="text" name="elective_title" id="elective_title" class="form-control" placeholder=" " required>
        <label>Course Title *</label>
    </div>

    <!-- Instructor -->
    <div class="col-md-6 floating-field">
        <input type="text" name="instructor_name" id="instructor_name" class="form-control" placeholder=" " required>
        <label>Instructor *</label>
    </div>

    <!-- Category -->
    <div class="col-md-4">
        <label class="form-label small">Category *</label>
        <select name="category_id" id="category_id" class="form-select" onchange="loadSkills(this.value)">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->category_id }}">
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Skills -->
    <div class="col-md-4">
        <label class="form-label small">Skills *</label>
        <select name="skills[]" id="skills" class="form-select" multiple>
        </select>
    </div>

    <!-- Duration -->
    <div class="col-md-4 floating-field">
        <input type="text" name="duration" id="duration" class="form-control" placeholder=" ">
        <label>Duration *</label>
    </div>

    <!-- Price -->
    <div class="col-md-4 floating-field">
        <input type="number" name="price" id="price" class="form-control" placeholder=" ">
        <label>Price (₹) *</label>
    </div>

    <!-- Start Date -->
    <div class="col-md-4 floating-field">
        <input type="date" name="start_date" id="start_date" class="form-control" placeholder=" ">
        <label>Start Date *</label>
    </div>

    <!-- Status -->
    <div class="col-md-4">
        <label class="form-label small">Status</label>
        <select name="status" id="status" class="form-select">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <!-- Description -->
    <div class="col-12 floating-field">
        <textarea rows="3" name="description" id="description" class="form-control" placeholder=" "></textarea>
        <label>Description</label>
    </div>

</div>
</form>