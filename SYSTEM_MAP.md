# Acadex — System Map (as-built)

> Generated 2026-07-05 from a full codebase exploration on the `dev` branch.
> Based on actual pages, includes, AJAX endpoints, and the dynamic schema in the code — not assumptions.

**Housekeeping note:** the portal root directory is spelled `administration/` (git tracks it that way on `dev`), not the older `admistration/` referenced in some internal docs.

## 1. Roles and portals

All portals live under `administration/`. Every role has its own login → emailed ID-code verification → session-gated home (the gate lives in each module's `header.php`, e.g. `$_SESSION['admin_id_code']`). There is no unified auth or permissions matrix.

| Role | Module | What they can actually do |
|---|---|---|
| **Director** | `director/` | Register principals, verify their email, view principal details. Thinnest portal. **Logs in with a plaintext password compared in SQL** (`director_login_action.php`: `WHERE email = '$email' AND pwd = '$password'`) — every other role uses `password_verify()`. No page registers a director; `director_login_table` must be seeded by hand. |
| **Principal** | `principal/` | Register/verify/manage the four officer roles (academic, exam, finance, admin personnel) with load/fetch/update/delete AJAX in `multipurpose_action.php`; read-only views of school fees, deposits, withdrawals for both arms; **approves withdrawal transactions**. |
| **Admin Officer** | `admin_officer/` | The operational hub: student/pupil registration and editing; class registration (which **dynamically CREATEs ~14 MySQL tables per class** — exam, 3 CA tables, attendance, term tables, online-exam question/option tables — in `action_php/class_table_creation_action.php`); subject registration; class insertion (single/multiple); PIN generation; staff registration + staff daily/termly attendance; creation of form-master attendance credentials (emailed); news creation/editing; viewing public contact-form messages (`view_message.php`); dompdf prints of student/pupil/staff details. |
| **Academic Officer** | `academic_officer/` | Performance analytics (general/subject/class × CA/exam/result × students/pupils) **plus a real approval workflow**: approve/disapprove single or all CA and exam results (`multipurpose_action.php`). |
| **Exam Officer** | `exam_officer/` + `personal_file/` + `personal_file/e_exam/` | The results engine. `personal_file/`: bulk and single CA/exam score entry per class, result compilation views with per-subject class positions, result prints (dompdf). `e_exam/`: create online exams, add/edit/delete questions and options, open/close exam status, view/print/remove online exam results. All duplicated for pupils. |
| **Finance Officer** | `finance/` | Generate class vouchers, set/edit voucher amounts, add students/pupils to vouchers, record fee payments, deposits, withdrawals, per-student and per-class fee detail views, printable transaction PDFs. |
| **Form master/mistress** | `student_attendance/`, `pupil_attendance/` | Term-scoped login using credentials created by the admin officer (`student_attendance_creation_table` — login only works while `attendance_status = 'open'`); take daily attendance, edit it, view daily and termly summaries for their class. |
| **Students / Pupils** | `online_exam/`, `pupil_online_exam/` | Sit online exams only. Double gate: exam officer logs into the hall machine first (`$_SESSION['exam_user_name']`), then the student logs in with admission number + generated PIN, picks term/session/class/subject, and takes a randomized MCQ exam with navigation, option selection, and auto-marking. |
| **Public / parents** | repo root | Marketing pages (`index.php`, `about.php`), published news (`news.php`, `news_view.php`), contact form (emails staff via PHPMailer and inserts into `contact_us_table`). **Parents have no authenticated capability at all.** |

## 2. Functional modules and their state

| Module | State | Evidence / notes |
|---|---|---|
| Per-role auth (login, ID-code email, forgot/reset password) | **Working** across all 8 role types | `*_idcode_verification.php` + per-module `multipurpose_action.php`; director is the plaintext outlier |
| Student/pupil/staff registration & editing | **Working** | `admin_officer/` form + detail + edit + delete pages, image editing actions |
| Class & subject setup | **Working but rigid** | Class registration auto-creates per-class tables with **hardcoded subject columns** (`eng, rel, ent, phy, che, bio, mat, f_m, eco, agri, geo, com, civ…`). `subject_table` only feeds dropdowns (online exam creation, academic-officer forms) — registering a new subject does **not** add it to grading |
| CA / exam score entry & result compilation | **Working** | `exam_officer/personal_file/` — insertion, editing, class/single views, position calculation, dompdf result prints |
| Result approval | **Working** | Academic officer approve/disapprove actions |
| Online exams (CBT) | **Working end-to-end** | Creation → questions/options → status open/close → student sitting → auto-marking → result views/prints/removal |
| Attendance (students, pupils, staff) | **Working** | Admin officer provisions form-master credentials per term; form masters take/edit/view; staff attendance taken by admin officer directly |
| Fees / vouchers / deposits / withdrawals | **Working**, with principal approval on withdrawals | `finance/` + `class_voucher_table`, `school_deposit_transaction_table`, `school_withdraw_transaction_table` (+ pupil twins) |
| PIN generation | **Working but narrower than advertised** | `student_pin_action.php` just sets `pwd` on `student_registration_table`; the only thing that verifies it is **online exam login**. PINs do *not* gate result checking — no such page exists |
| News/announcements | **Working** | Created as `'not published'`, published via edit; public `news.php` shows `status = 'published'` |
| Contact/enquiries | **Working** | Public form → email + `contact_us_table` → admin officer `view_message.php` |
| Admissions | **Does not exist** | No public application form; all enrollment is admin-officer data entry |
| Parent/student result portal | **Does not exist** | All result views sit behind `$_SESSION['exam_officer_id_code']` (e.g. `student_result_personal_detail_view.php`) |

## 3. Journeys wired end-to-end

1. **Staff onboarding chain**: Director → registers principal → email verify → principal logs in → registers the four officers → each verifies email → each logs into own portal. Fully wired.
2. **Academic year setup → results**: Admin officer registers classes (tables auto-created) → registers students → inserts them into classes → exam officer enters CA + exam scores → academic officer approves → exam officer compiles/prints results with positions.
3. **Online exam**: Exam officer creates exam + questions in `e_exam` → sets status open → admin officer generates student PINs → exam officer unlocks the hall machine → student logs in, sits randomized MCQs, auto-marked → exam officer views/prints results.
4. **Attendance term cycle**: Admin officer creates form-master credentials (status `close` until opened, email verification) → form master logs in → daily attendance → termly summaries → admin officer can view/edit centrally.
5. **Fees**: Finance officer generates class voucher → sets amounts → adds students → records payments/deposits/withdrawals → principal approves withdrawals → printable transaction PDFs.
6. **News**: Admin officer creates (draft) → publishes → appears on public `news.php`.

## 4. Gaps, dead ends, and debt

### Security (P0 material)

- Director login is a plaintext SQL comparison (`director_login_action.php`).
- Live-looking production DB credentials commented in `action_php/database.php` (`springo4_grace` + password).
- SMTP password hardcoded in `student_attendance_creation_form_action.php` (and commented Gmail app passwords across many files).
- **Hardcoded constant tokens** for password/email flows (`$pwd_code = 'jz6w9jzh6w2'`, `$pwd_token = 'hs6i29i2o'`).
- Table names interpolated straight from user input into SQL (`SELECT * FROM $class_table …` in `online_exam/action_php/multipurpose_action.php`).

### Product dead ends

- **The PIN is a dead end for its implied purpose**: parents/students cannot check results anywhere; the PIN only unlocks CBT login. The result-checker page the PIN system implies was never built.
- **Subject registration is cosmetic**: the grading schema is frozen into hardcoded columns per class table; adding a real subject requires schema surgery.
- **No admissions**: no public application form; all enrollment is admin-officer data entry.

### Code debt

- Dead/leftover code: `admin_officer/residuw.php` (187-line duplicate of the student-detail page), `pupil_online_exam/action_php/student_complete_online_exam_question_action.php` (copy-paste from the student module), `res.php` / `res_odd_odd.php` / `res_old.php` in the exam officer's folder (iteration leftovers), empty `action_php/email_config.php`.
- **No schema file in the repo** — the `spring` DB's static tables (registration tables, news, vouchers, etc.) exist only implicitly; only per-class tables have CREATE statements in code.
- Structural: everything is duplicated student/pupil (double build cost), one `database.php` per module, no director self-service registration, and typo'd filenames persist (`deatils`, `simgle`, `romove`, `finanace`).
