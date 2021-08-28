const url = document.location.origin + "/api/";

function ShowAlert(data, message) {
  $(function () {
    $(data).siblings(".alert").removeClass("visually-hidden");
    $(data).siblings(".alert").children(".message").text(message);
  });
}

function RemoveMessage(data) {
  $(function () {
    $(data).siblings(".alert").children(".message").text("");
    $(data).closest(".alert").addClass("visually-hidden");
  });
}

function UpdateCoach(data, type, id) {
  $(function () {
    const value = $(data).val();
    RemoveMessage(data);
    $.ajax({
      url,
      dataType: "json",
      type: "POST",
      data: { type, status: "update", data: `value=${value}&id=${id}` },
    }).then(({ message }) => {
      ShowAlert(data, message);
    });
  });
}

function Block(data, type, id) {
  $(function () {
    if (type == "user" || type == "coach") {
      id = $(data).siblings("select").val();
    }
    RemoveMessage(data);
    $.ajax({
      url,
      data: { type, status: "block", data: `id=${id}` },
    }).then(({ message }) => {
      ShowAlert(data, message);
    });
  });
}

function toggleTabs(data) {
  $(function () {
    const buttons = ["first", "second", "third"];
    buttons.forEach((el) => {
      if ($(data).hasClass(el)) {
        buttons.filter((ele) => {
          if (ele != el) {
            $(`.${ele}`).removeClass("active");
          }
        });
      }
    });
    $(data).addClass("active");
  });
}

$(window).on("shown.bs.modal", function (e) {
  if (e.target.id.includes("ex")) {
    UpdateCoach(null, "exercise", e.target.id.split("-")[1]);
  }
});

function Update(data, type) {
  $(function () {
    const formData = $(data).closest("form").serialize();
    RemoveMessage(data);
    $.ajax({
      url,
      dataType: "json",
      type: "POST",
      data: { type, status: "update", data: formData },
    }).then(({ message }) => {
      ShowAlert(data, message);
    });
  });
}

function Delete(type, id) {
  $(function () {
    $.ajax({
      url,
      dataType: "json",
      type: "POST",
      data: { type, status: "delete", data: `id=${id}` },
    }).then(() => {
      location.reload();
    });
  });
}

function Create(data, type) {
  $(function () {
    const formData = $(data).closest("form").serialize();

    RemoveMessage(data);
    $.ajax({
      url,
      dataType: "json",
      type: "POST",
      data: { type, status: "create", data: formData },
    }).then(({ message }) => {
      ShowAlert(data, message);
    });
  });
}

function AddExercise(data, categories) {
  $(function () {
    console.log(categories);
    $(".exercise").append(`
    <form class='el exercises-elem card'>
      <div>
        <select name="category" class='form-select'>
          ${categories.map(
            (el) => `<option value="${el.id}">${el.category_name}</option>`
          )}
        </select>
      </div>

      <div>
          <label style='font-weight:bold;'>Video embedded url</label>
          <input name="video" class='form-control'></input>
      </div>

      <div>
        <label style='font-weight:bold;'>Exercise name</label>
        <input name="ex_name" class='form-control'></input>
      </div>

      <div class='field-single'>
          <label style='font-weight:bold;'>Duration</label>
          <input name='ex_duration' class='form-control'>
      </div>

      <div class='field-single'>
          <label style='font-weight:bold;'>Description</label>
          <input name='desc' class='form-control'/>
      </div>
      
      <div>
          <button type='button' onclick=\"Create(this,'exercise')\" class='btn btn-secondary mt-3'>Create</button>
          <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
              <span class='message'></span>
              <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
              </button>
          </div>
      </div>
  </form>
    `);
  });
}

function renderForm(data, filter) {
  $(function () {
    const value = JSON.parse(filter)[$(data).val()]["category_name"];
    console.log(filter, value);
    $(".categories").empty();
    if ($(data).val() != "")
      $(".categories").append(
        `
      <div class='company-details' style='flex-basis:49%;'>
        <div class='job-update'>
          <h4><b>${value}</b></h4>
          <form>
              <div class='form-group mt-3'>
                  <label for='job_name' class='d-flex gap-5 flex-wrap''>Category Name</label>
                  <input class='form-control' type=\"text\" name='name' value='${value}'/>
              </div>

              <div>
                <button onclick=\"saveCategory(this,'category', '${value}')\" type='button' class='btn btn-primary mt-3'>Save</button>
                <button onclick=\"deleteCategory(this,'category', '${value}')\" type='button' class='btn btn-primary mt-3'>Delete</button>
              </div>
          </form>
        </div>
      </div>
      `
      );
  });
}

function saveCategory(data, type, value) {
  const formData = $(data).closest("form").serialize();
  let newData = formData + `&old=${encodeURIComponent(value)}`;

  $(function () {
    $.ajax({
      url,
      data: { type, status: "update", data: newData },
    }).then(() => {
      location.reload();
    });
  });
}

function deleteCategory(data, type, value) {
  let newData = `&old=${encodeURIComponent(value)}`;
  $(function () {
    $.ajax({
      url,
      data: { type, status: "delete", data: newData },
    }).then(() => {
      location.reload();
    });
  });
}

function createCategory(data, type) {
  const formData = $(data).closest("form").serialize();
  $(function () {
    $.ajax({
      url,
      data: { type, status: "create", data: formData },
    }).then(() => {
      location.reload();
    });
  });
}

function renderNewCategory() {
  $(function () {
    $(".categories").empty();
    $(".categories").append(
      `
      <div class='company-details' style='flex-basis:49%;'>
        <div class='job-update'>
          <h4><b>New Category</b></h4>
          <form>
              <div class='form-group mt-3'>
                  <label for='job_name' class='d-flex gap-5 flex-wrap''>Category Name</label>
                  <input class='form-control' type=\"text\" name='name'/>
              </div>

              <div>
                <button onclick=\"createCategory(this,'category')\" type='button' class='btn btn-primary mt-3'>Save</button>
              </div>
          </form>
        </div>
      </div>
      `
    );
  });
}
