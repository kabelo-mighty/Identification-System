<?php
include '../src/connect.php';
require_once '../src/auth.php';

function register_field_has_valid_name($value)
{
  return (bool) preg_match("/^[A-Za-z][A-Za-z '\-]{1,99}$/", $value);
}

function register_field_has_valid_phone($value)
{
  return (bool) preg_match('/^\d{10}$/', $value);
}

function register_field_has_valid_zipcode($value)
{
  return (bool) preg_match('/^[A-Za-z0-9 -]{3,12}$/', $value);
}

function register_field_has_strong_password($value)
{
  return (bool) preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/', $value);
}

$flashMessage = app_get_flash_message();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
  $name = trim((string) ($_POST['name'] ?? ''));
  $surname = trim((string) ($_POST['surname'] ?? ''));
  $gender = trim((string) ($_POST['gender'] ?? ''));
  $year = trim((string) ($_POST['dob'] ?? ''));
  $dob = trim((string) ($_POST['dob1'] ?? ''));
  $idno = trim((string) ($_POST['idno'] ?? ''));
  $cellno = trim((string) ($_POST['cellno'] ?? ''));
  $keenfirstname = trim((string) ($_POST['keenfirstname'] ?? ''));
  $keenlastname = trim((string) ($_POST['keenlastname'] ?? ''));
  $kphone = trim((string) ($_POST['kphone'] ?? ''));
  $kemail = app_normalize_email($_POST['kemail'] ?? '');
  $houseno = trim((string) ($_POST['houseno'] ?? ''));
  $streetname = trim((string) ($_POST['streetname'] ?? ''));
  $suburb = trim((string) ($_POST['suburb'] ?? ''));
  $city = trim((string) ($_POST['city'] ?? ''));
  $province = trim((string) ($_POST['province'] ?? ''));
  $zipcode = trim((string) ($_POST['zipcode'] ?? ''));
  $country = trim((string) ($_POST['country'] ?? ''));
  $checkcountry = trim((string) ($_POST['selector'] ?? ''));
  $email = app_normalize_email($_POST['email'] ?? '');
  $password = (string) ($_POST['password'] ?? '');
  $confirmPassword = (string) ($_POST['Cpassword'] ?? '');
  $fullid = $dob . $idno;

  if (
    $name === '' ||
    $surname === '' ||
    $gender === '' ||
    $year === '' ||
    $dob === '' ||
    $idno === '' ||
    $cellno === '' ||
    $keenfirstname === '' ||
    $keenlastname === '' ||
    $kphone === '' ||
    $kemail === '' ||
    $houseno === '' ||
    $streetname === '' ||
    $suburb === '' ||
    $city === '' ||
    $province === '' ||
    $zipcode === '' ||
    $checkcountry === '' ||
    $email === '' ||
    $password === '' ||
    $confirmPassword === ''
  ) {
    app_redirect('register.php', 'Please complete the required registration fields.');
  }

  if (!register_field_has_valid_name($name) || !register_field_has_valid_name($surname)) {
    app_redirect('register.php', 'Please enter a valid first and last name.');
  }

  if (!in_array($gender, ['Male', 'Female'], true)) {
    app_redirect('register.php', 'Please choose a valid gender option.');
  }

  $dateOfBirth = DateTime::createFromFormat('Y-m-d', $year);
  if (!$dateOfBirth || $dateOfBirth->format('Y-m-d') !== $year || $dateOfBirth > new DateTime('today')) {
    app_redirect('register.php', 'Please enter a valid date of birth.');
  }

  if (!preg_match('/^\d{6}$/', $dob) || !preg_match('/^\d{7}$/', $idno) || !preg_match('/^\d{13}$/', $fullid)) {
    app_redirect('register.php', 'Please enter a valid ID number.');
  }

  if (!register_field_has_valid_phone($cellno) || !register_field_has_valid_phone($kphone)) {
    app_redirect('register.php', 'Please enter valid 10-digit phone numbers.');
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !filter_var($kemail, FILTER_VALIDATE_EMAIL)) {
    app_redirect('register.php', 'Please enter valid email addresses.');
  }

  if ($checkcountry !== 'other' && $checkcountry !== 'South Africa') {
    app_redirect('register.php', 'Please choose a valid country option.');
  }

  if ($checkcountry === 'other' && $country === '') {
    app_redirect('register.php', 'Please provide the country name.');
  }

  if (!register_field_has_valid_name($keenfirstname) || !register_field_has_valid_name($keenlastname)) {
    app_redirect('register.php', 'Please enter valid next of kin names.');
  }

  if (!register_field_has_valid_zipcode($zipcode)) {
    app_redirect('register.php', 'Please enter a valid zip code.');
  }

  if (!register_field_has_strong_password($password)) {
    app_redirect('register.php', 'Password must be at least 8 characters and include uppercase, lowercase, a number, and a special character.');
  }

  if (!hash_equals($password, $confirmPassword)) {
    app_redirect('register.php', 'Password confirmation does not match.');
  }

  $countryValue = $checkcountry === 'other' ? $country : 'South Africa';
  $passwordHash = app_hash_password($password);

  $checkStatement = mysqli_prepare($conn, 'SELECT person_id FROM person WHERE email = ? OR id_number = ? LIMIT 1');
  mysqli_stmt_bind_param($checkStatement, 'ss', $email, $fullid);
  mysqli_stmt_execute($checkStatement);
  $existing = mysqli_fetch_assoc(mysqli_stmt_get_result($checkStatement));
  mysqli_stmt_close($checkStatement);

  if ($existing) {
    app_redirect('register.php', 'An account with that email or ID number already exists. Please login instead.');
  }

  $insertStatement = mysqli_prepare(
    $conn,
    'INSERT INTO person(firstname, lastname, gender, dateOfbirth, id_number, phone, house_no, street_name, suburb, city, province, zip_code, country, keen_firstname, keen_lastname, keen_email, keen_phone, email, employee_type, password, confirmed_acc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
  );
  $employeeType = 'default';
  $confirmed = '0';
  mysqli_stmt_bind_param(
    $insertStatement,
    'sssssssssssssssssssss',
    $name,
    $surname,
    $gender,
    $year,
    $fullid,
    $cellno,
    $houseno,
    $streetname,
    $suburb,
    $city,
    $province,
    $zipcode,
    $countryValue,
    $keenfirstname,
    $keenlastname,
    $kemail,
    $kphone,
    $email,
    $employeeType,
    $passwordHash,
    $confirmed
  );
  $inserted = mysqli_stmt_execute($insertStatement);
  mysqli_stmt_close($insertStatement);

  if (!$inserted) {
    app_redirect('register.php', 'Account could not be created. Please try again.');
  }

  app_redirect('login.php', 'Account successfully created.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identification System | Register</title>
    <link rel="icon" href="../assets/img/logo.jpg">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Sora', 'ui-sans-serif', 'system-ui', 'sans-serif']
                    }
                }
            }
        };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/tailwind-ui.css">
</head>
<body class="app-shell hero-grid">
    <main class="mx-auto max-w-7xl px-6 py-8 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <a class="brand-badge" href="../index.php">
                    <i class="fa fa-chevron-left"></i>
                    Back to home
                </a>
                <div class="app-kicker mt-6">Citizen onboarding</div>
                <h1 class="mt-3 max-w-3xl text-4xl font-extrabold text-white md:text-5xl">Register into a modern identity workspace.</h1>
                <p class="mt-4 max-w-3xl text-base leading-7 text-slate-300">Create a complete person record with personal data, address information, next-of-kin details, and account credentials in one guided form.</p>
            </div>
            <div class="glass-panel rounded-[1.75rem] p-5 lg:max-w-sm">
                <div class="app-badge app-badge-info">Flow summary</div>
                <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                    <li>Personal identity details are captured first.</li>
                    <li>Address and next-of-kin information complete the record.</li>
                    <li>The account is created and awaits confirmation.</li>
                </ul>
            </div>
        </div>

        <div class="mb-6">
            <?php echo app_render_flash_banner($flashMessage); ?>
        </div>

        <form method="post" action="" class="glass-panel-strong app-card rounded-[2rem] p-6 md:p-8">
            <div class="grid gap-6 xl:grid-cols-2">
                <section class="app-form-section space-y-5">
                    <div>
                        <div class="app-kicker">Section 1</div>
                        <h2 class="mt-2 text-2xl font-bold text-white">Personal information</h2>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="name">First name</label>
                            <input class="app-input" type="text" id="name" name="name" required>
                        </div>
                        <div>
                            <label class="app-label" for="surname">Last name</label>
                            <input class="app-input" type="text" id="surname" name="surname" required>
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="dob">Date of birth</label>
                            <input class="app-input" type="date" id="dob" name="dob" required>
                        </div>
                        <div>
                            <label class="app-label" for="cellno">Phone number</label>
                            <input class="app-input" type="text" id="cellno" name="cellno" placeholder="0712345678" required>
                        </div>
                    </div>

                    <div>
                        <label class="app-label">Gender</label>
                        <div class="grid gap-3 sm:grid-cols-2">
                            <label class="rounded-2xl border border-slate-700 bg-slate-950/50 p-4 text-slate-200">
                                <input type="radio" name="gender" value="Male" class="mr-3" required>
                                Male
                            </label>
                            <label class="rounded-2xl border border-slate-700 bg-slate-950/50 p-4 text-slate-200">
                                <input type="radio" name="gender" value="Female" class="mr-3" required>
                                Female
                            </label>
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-[0.9fr_1.1fr]">
                        <div>
                            <label class="app-label" for="dob1">ID prefix</label>
                            <input class="app-input" type="text" id="dob1" name="dob1" maxlength="6" readonly placeholder="YYMMDD" required>
                        </div>
                        <div>
                            <label class="app-label" for="idno">ID suffix</label>
                            <input class="app-input" type="text" id="idno" name="idno" maxlength="7" placeholder="Last 7 digits" required>
                        </div>
                    </div>
                </section>

                <section class="app-form-section space-y-5">
                    <div>
                        <div class="app-kicker">Section 2</div>
                        <h2 class="mt-2 text-2xl font-bold text-white">Address information</h2>
                    </div>

                    <div>
                        <label class="app-label" for="selector">Citizenship</label>
                        <select class="app-select" id="selector" name="selector" required>
                            <option value="">Select status</option>
                            <option value="South Africa">South African</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="houseno">House number</label>
                            <input class="app-input" type="text" id="houseno" name="houseno" required>
                        </div>
                        <div>
                            <label class="app-label" for="streetname">Street name</label>
                            <input class="app-input" type="text" id="streetname" name="streetname" required>
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="suburb">Suburb</label>
                            <input class="app-input" type="text" id="suburb" name="suburb" required>
                        </div>
                        <div>
                            <label class="app-label" for="city">City</label>
                            <input class="app-input" type="text" id="city" name="city" required>
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="province">Province</label>
                            <input class="app-input" type="text" id="province" name="province" required>
                        </div>
                        <div>
                            <label class="app-label" for="zipcode">Zip code</label>
                            <input class="app-input" type="text" id="zipcode" name="zipcode" required>
                        </div>
                    </div>

                    <div id="country-wrapper" class="hidden">
                        <label class="app-label" for="country">Country</label>
                        <input class="app-input" type="text" id="country" name="country" placeholder="Enter country name">
                    </div>
                </section>

                <section class="app-form-section space-y-5">
                    <div>
                        <div class="app-kicker">Section 3</div>
                        <h2 class="mt-2 text-2xl font-bold text-white">Next of kin</h2>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="keenfirstname">First name</label>
                            <input class="app-input" type="text" id="keenfirstname" name="keenfirstname" required>
                        </div>
                        <div>
                            <label class="app-label" for="keenlastname">Last name</label>
                            <input class="app-input" type="text" id="keenlastname" name="keenlastname" required>
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label class="app-label" for="kphone">Phone number</label>
                            <input class="app-input" type="text" id="kphone" name="kphone" required>
                        </div>
                        <div>
                            <label class="app-label" for="kemail">Email address</label>
                            <input class="app-input" type="email" id="kemail" name="kemail" required>
                        </div>
                    </div>
                </section>

                <section class="app-form-section space-y-5">
                    <div>
                        <div class="app-kicker">Section 4</div>
                        <h2 class="mt-2 text-2xl font-bold text-white">Account credentials</h2>
                    </div>

                    <div>
                        <label class="app-label" for="email">Email address</label>
                        <input class="app-input" type="email" id="email" name="email" required>
                    </div>
                    <div>
                        <label class="app-label" for="password">Password</label>
                        <input class="app-input" type="password" id="password" name="password" required>
                    </div>
                    <div>
                        <label class="app-label" for="Cpassword">Confirm password</label>
                        <input class="app-input" type="password" id="Cpassword" name="Cpassword" required>
                    </div>

                    <div class="rounded-2xl border border-emerald-400/15 bg-emerald-400/8 p-4 text-sm leading-6 text-emerald-100">
                        Passwords must contain uppercase, lowercase, a number, a special character, and be at least 8 characters long.
                    </div>
                </section>
            </div>

            <div class="app-divider my-8"></div>

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm leading-6 text-slate-300">Already have an account? <a class="font-semibold text-sky-300 hover:text-sky-200" href="login.php">Sign in here</a>.</p>
                <button class="app-button app-button-primary" type="submit">
                    <i class="fa fa-user-plus"></i>
                    Register account
                </button>
            </div>
        </form>
    </main>

    <script>
        const dobInput = document.getElementById('dob');
        const dobPrefixInput = document.getElementById('dob1');
        const citizenshipSelect = document.getElementById('selector');
        const countryWrapper = document.getElementById('country-wrapper');
        const countryInput = document.getElementById('country');

        function updateDobPrefix() {
            if (!dobInput.value) {
                dobPrefixInput.value = '';
                return;
            }

            const [year, month, day] = dobInput.value.split('-');
            dobPrefixInput.value = (year || '').slice(-2) + (month || '') + (day || '');
        }

        function updateCountryField() {
            const showCountry = citizenshipSelect.value === 'other';
            countryWrapper.classList.toggle('hidden', !showCountry);

            if (showCountry) {
                countryInput.setAttribute('required', 'required');
            } else {
                countryInput.removeAttribute('required');
                countryInput.value = '';
            }
        }

        dobInput.addEventListener('change', updateDobPrefix);
        citizenshipSelect.addEventListener('change', updateCountryField);
        updateDobPrefix();
        updateCountryField();
    </script>
</body>
</html>