<form id="{{ $formId ?? 'courseForm' }}">
<div class="row g-4">

    <!-- Hidden ID (for edit) -->
    <input type="hidden" name="elective_id" id="elective_id">

    <!-- Course Title -->
    <div class="col-md-6 floating-field">
        <input type="text" name="elective_title" id="elective_title" class="form-control" placeholder=" ">
        <label>Course Title *</label>
    </div>

    <!-- Faculty -->
    <div class="col-md-6 floating-field">
        <select name="faculty_id" id="faculty_id" class="form-select">
            <option value="">Select Faculty</option>
            @foreach($faculties as $faculty)
                <option value="{{ $faculty->faculty_id }}">
                    {{ $faculty->name }}
                </option>
            @endforeach
        </select>
        <label>Faculty *</label>
    </div>

    <!-- Category -->
    <div class="col-md-4 floating-field">
        <select name="category_id" id="category_id" class="form-select">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <label>Category *</label>
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

    <!-- Skills -->
    <div class="col-md-8">
        <label class="form-label small">Skills *</label>
        <div id="skillsContainer" class="skills-checkbox-grid"></div>
    </div>

    <!-- Description -->
    <div class="col-12 floating-field">
        <textarea rows="3" name="description" id="description" class="form-control" placeholder=" "></textarea>
        <label>Description</label>
    </div>

</div>
</form>