# MicroCampus — Complete Feature & Module Guide

> **Audience:** Marketing & Sales Team
> **Document Version:** 1.0.3 (Expanded)
> **Date:** November 6, 2025

---

## What is MicroCampus?

MicroCampus is an all-in-one school management platform that digitizes every operation of a school — from student admissions and daily attendance to fee collection, exam results, HR payroll, and parent communication. It is built for the Bangladeshi education context, with native support for local payment gateways (bKash, Nagad, SSLCommerz) and Bangla language.

---

## Table of Contents

1. [Central Administration & School Management](#1-central-administration--school-management)
2. [Academic & Curriculum Management](#2-academic--curriculum-management)
3. [Student Information System (SIS)](#3-student-information-system-sis)
4. [Parent & Guardian Engagement Portal](#4-parent--guardian-engagement-portal)
5. [Teacher & Faculty Dashboard](#5-teacher--faculty-dashboard)
6. [Smart Attendance System](#6-smart-attendance-system)
7. [Finance & Fee Management Module](#7-finance--fee-management-module)
8. [Examination & Result Management](#8-examination--result-management)
9. [Integrated Communication Hub](#9-integrated-communication-hub)
10. [Digital Library System](#10-digital-library-system)
11. [Transport & Route Management](#11-transport--route-management)
12. [HR & Payroll Management](#12-hr--payroll-management)
13. [Advanced Reporting & Analytics Dashboard](#13-advanced-reporting--analytics-dashboard)
14. [System Settings & Customization](#14-system-settings--customization)
15. [Future Roadmap (Planned Modules)](#15-future-roadmap-planned-modules)

---

## 1. Central Administration & School Management

> **What it is:** The command center of MicroCampus. This is where principals and administrators get a bird's-eye view of the entire school and control every operational setting.

---

### 1.1 Unified Statistics Dashboard

**What it does:**
Displays all critical school metrics on a single screen in real time. No need to jump between modules — everything is visible at once.

**Easy Example:**
The Principal opens MicroCampus at 9:05 AM and immediately sees:

| Metric | Value |
|---|---|
| Average Daily Attendance | 92% |
| Fees Collected This Month | ৳8,50,000 |
| New Admission Enquiries | 52 |
| Pending Fee Dues | 134 students |

She doesn't need to open a single report — the dashboard tells the whole story.

---

### 1.2 Comprehensive User Management

**What it does:**
Allows admins to create, search, edit, and manage profiles for every person in the school — admins, teachers, students, and staff.

**Easy Example:**
The admin needs to move a teacher to a new class:

1. Admin searches: `"Md. Karim"` → Teacher profile opens.
2. Admin updates his assigned class from **`7A → 7B`**.
3. Admin resets his forgotten password.
4. Saves. Done — all in under 2 minutes.

---

### 1.3 Role & Permission Management

**What it does:**
Controls exactly what each user type (role) can see and do inside the system. This protects sensitive data and maintains a clear chain of responsibility.

**Easy Example:**
The school hires a new librarian. The admin:

- Creates a role called **`Librarian`**
- Grants access **only** to the `Library Management` module
- Blocks access to `Fees & Accounting`, `HR`, and `Exam Results`

The librarian logs in and sees only what they need — nothing more.

> **Why it matters for sales:** Schools with multiple staff types (accountant, librarian, coordinator) love this feature because it prevents accidental or unauthorized data changes.

---

### 1.4 School & Academic Year Settings

**What it does:**
Personalizes the platform with the school's identity and defines the academic calendar year the system operates in.

**Easy Example:**
A new school onboards onto MicroCampus:

- Uploads their logo → appears on every page, report card, and receipt
- Sets system name: **`"Sunrise International School"`**
- Defines academic session: **`"2026–2027"`**
- All subsequent data (students, fees, results) is automatically tied to this session

---

### 1.5 Database & System Integrity

**What it does:**
Protects the school's entire data with scheduled backups and a restore tool, so data is never permanently lost due to accidents or system failures.

**Easy Example:**
The admin configures:

- **Automatic backup:** Every night at **2:00 AM**, a full snapshot of the database is saved.
- **Disaster scenario:** A staff member accidentally deletes an entire class's attendance records.
- **Recovery:** Admin restores from last night's backup — all records are back in minutes.

---

## 2. Academic & Curriculum Management

> **What it is:** The tools used to build and organize the school's academic structure — classes, subjects, teachers, timetables, and the school calendar.

---

### 2.1 Class & Section Management

**What it does:**
Defines the school's class hierarchy, including sections differentiated by shift (Morning/Day) or version (Bangla/English).

**Easy Example:**

Admin sets up **Class 6** with three sections:

| Section | Shift | Version |
|---|---|---|
| 6A | Morning | Bangla Medium |
| 6B | Day | English Medium |
| 6C | Morning | English Medium |

Each section operates independently — different teachers, different routines, different fee structures.

---

### 2.2 Subject & Syllabus Management

**What it does:**
Defines which subjects exist in the school and maps them to the classes that need them.

**Easy Example:**

| Subject | Class 8 | Class 9 | Class 10 |
|---|---|---|---|
| Higher Math | ❌ | ✅ | ✅ |
| Biology | ❌ | ✅ | ✅ |
| General Science | ✅ | ❌ | ❌ |

Higher Math and Biology are only relevant to Class 9 and 10 — the admin assigns them accordingly, and they won't appear in Class 8 mark sheets or timetables.

---

### 2.3 Teacher & Subject Assignment

**What it does:**
Links a specific teacher to a specific class and subject combination, establishing clear responsibility for teaching.

**Easy Example:**

| Teacher | Subject | Assigned Classes |
|---|---|---|
| Mrs. Salma | English | Class 7A, Class 7B |
| Mr. Hasan | Mathematics | Class 9A, Class 10A |

Mrs. Salma's attendance input and result sheet will only show her assigned classes. She cannot accidentally enter marks for a class she doesn't teach.

---

### 2.4 Class Routine (Weekly Timetable)

**What it does:**
A visual drag-and-drop style builder for creating the weekly class schedule. Includes automatic conflict detection.

**Easy Example:**
Admin builds the **Class 8A** routine:

- Period 1, Sunday → **Math** (Teacher: Mr. Hasan)
- Period 2, Sunday → **English** (Teacher: Mrs. Salma)

If admin tries to assign Mr. Hasan to **Period 1, Sunday** for **Class 9A** simultaneously, the system shows:

> ⚠️ **Conflict Detected:** Mr. Hasan is already assigned to Class 8A at this time.

This prevents double-booking teachers and ensures a clean, conflict-free schedule.

---

### 2.5 Academic Calendar

**What it does:**
A centralized school calendar where admins post important dates — holidays, events, exam schedules, and meetings. All users see it automatically.

**Easy Example:**

Admin posts an event:
- **Event:** Annual Sports Day
- **Date:** February 15th
- **Visibility:** All Users

Result: The event automatically appears on the dashboards of every parent, student, and teacher logged into MicroCampus — no need to send separate messages.

---

## 3. Student Information System (SIS)

> **What it is:** The complete digital record for every student — from the day they enroll to the day they graduate or transfer.

---

### 3.1 Student Admission & Profile

**What it does:**
Manually enrolls new students and creates a rich digital profile for each one, including personal, academic, and guardian details.

**Easy Example:**

Admin enrolls a new student:

| Field | Value |
|---|---|
| Name | Fatima Ahmed |
| Photo | Uploaded ✅ |
| Guardian Contact | 01711-XXXXXX |
| Address | Dhanmondi, Dhaka |
| Previous School | Green Valley School |
| **Auto-Generated Student ID** | **S-2026-045** |

The Student ID is unique and is used across all modules — attendance, fees, results, and the library.

---

### 3.2 Student Promotion

**What it does:**
At the end of an academic year, promotes all "Passed" students to the next class in a single bulk action, eliminating hours of manual re-enrollment.

**Easy Example:**

After final results are published:

1. Admin filters: **Class 8 → Status: Passed** → 38 students selected
2. Clicks **"Promote to Class 9"**
3. All 38 students are instantly moved — their new class, fee structure, and subjects update automatically
4. Students who failed remain in Class 8 for the next session

---

### 3.3 Transfer Certificate (TC) Generator

**What it does:**
Instantly generates a print-ready, official Transfer Certificate for any student, formatted with the school's letterhead.

**Easy Example:**

A parent comes to the office requesting a TC because their family is relocating:

1. Admin searches student: `"Rahim Khan – Class 7"`
2. Clicks **"Generate TC"**
3. A PDF is created instantly, containing:
   - School letterhead and logo
   - Student's full details and enrollment history
   - Conduct and attendance summary
4. Admin prints it and hands it over — the whole process takes less than a minute.

---

### 3.4 Exam Admit Card Generator

**What it does:**
Automatically generates admit cards for students before exams, with their photo, exam schedule, and roll number pre-filled.

**Easy Example:**

Two weeks before the Final Exam:

- Admin selects: **Class 10 → Generate Admit Cards**
- 60 individual admit cards are generated instantly
- Each card includes: Student photo, Roll No., Exam schedule (subject-wise dates and times), and Examination Center
- Printed and distributed — no manual writing needed

---

## 4. Parent & Guardian Engagement Portal

> **What it is:** A dedicated, secure login for parents to stay informed about their child's school life — results, attendance, fees, and announcements — all in one place.

---

### 4.1 Student Progress Dashboard

**What it does:**
Gives parents a real-time academic snapshot of their child: attendance rate, subject-wise grades, and school notices.

**Easy Example:**

A mother logs into the parent portal on her phone and sees:

| Info | Detail |
|---|---|
| Attendance This Month | 95% ✅ |
| Math (Mid-Term) | A |
| English (Mid-Term) | B- |
| Latest Notice | Parent-Teacher Meeting – Nov 10th |

She knows exactly how her child is performing — without calling the school.

---

### 4.2 Integrated Online Fee Payment

**What it does:**
Lets parents view their pending invoices and pay fees directly online using Bangladeshi payment methods — no need to visit the school physically.

**Easy Example:**

A parent receives an SMS:
> *"Dear Parent, ৳2,000 Tuition Fee is due for November. Pay online at [link]."*

The parent:
1. Opens the portal link
2. Sees the invoice: **৳2,000 – November Tuition Fee**
3. Selects **bKash** as payment method
4. Pays instantly
5. Receives a digital receipt immediately

**Supported Payment Methods:**
- bKash
- Nagad
- Rocket
- SSLCommerz (all cards and MFS options)

---

### 4.3 Communication & Notifications

**What it does:**
Keeps parents informed about all school events and makes it easy to connect with teachers.

**Easy Example:**

A parent notices a "Parent-Teacher Meeting" announcement on the portal for **November 10th**. They also need to discuss their child's Science performance, so they look up the Science teacher's contact details — also available in the portal — and schedule a call directly.

---

## 5. Teacher & Faculty Dashboard

> **What it is:** The teacher's personal digital workspace — everything they need to manage their classes, enter marks, submit results, and stay organized.

---

### 5.1 Attendance & Mark Management

**What it does:**
Provides a simple, fast interface for teachers to take daily class attendance and enter exam marks from any device.

**Easy Example:**

**Attendance:** At 8:55 AM, a teacher opens MicroCampus on their mobile, selects **Class 7A**, and taps Present/Absent for each student. Submitted in 90 seconds.

**Marks Entry:** After the Biology exam, the teacher opens the marks entry screen for **Biology – Class 9A** and types in each student's score. The system handles the rest automatically.

---

### 5.2 Auto-Grading System

**What it does:**
Automatically converts raw marks into grades (A+, A, B, etc.) and GPA values based on the grading scale configured by the admin.

**Easy Example:**

The teacher enters **85** for a student:

| Input | Auto-Calculated |
|---|---|
| Marks: 85 | Grade: **A+** |
| | Grade Points: **5.00** |

The teacher never has to manually calculate grades. The system applies the school's own grading rules instantly for all students at once.

---

### 5.3 Class Routine & Resources

**What it does:**
Lets teachers view their personal weekly timetable and access relevant student and parent contact information.

**Easy Example:**

A teacher logs in on Tuesday morning and checks their personal routine:

| Period | Time | Class |
|---|---|---|
| 1st | 9:00 AM | Class 7A – English |
| 3rd | 11:00 AM | Class 8B – English |
| 5th | 1:00 PM | Free Period |

They also pull up the parent contact list for Class 8B before the parent-teacher meeting.

---

### 5.4 Result Sheet Submission

**What it does:**
Once all marks are entered, the teacher formally submits (locks) their result sheet to the administration for review and publishing.

**Easy Example:**

After entering all 45 students' final exam marks:

1. Teacher reviews the marks one last time
2. Clicks **"Submit Result Sheet"**
3. Marks are **locked** — no further edits possible without admin approval
4. Admin receives a notification: *"Class 9A Biology results submitted by Mrs. Rima"*
5. Admin reviews and clicks **"Publish"**

This approval workflow prevents accidental edits after submission.

---

## 6. Smart Attendance System

> **What it is:** A comprehensive system for tracking daily attendance for both students and staff, with automated alerts and detailed reporting.

---

### 6.1 Daily Attendance Tracking

**What it does:**
Records and stores daily attendance for both students (class-wise) and staff (office check-in).

**Easy Example:**

- **Students:** Teacher takes Class 8B attendance by 9:00 AM from their mobile or desktop.
- **Staff:** Office staff sign in at the front desk, and the system logs their arrival time.

Both records are stored separately and available for reporting.

---

### 6.2 Automated Absentee Notifications

**What it does:**
The moment a student is marked absent, an SMS is automatically sent to their registered parent/guardian — no manual action needed.

**Easy Example:**

A student named **Rahim** doesn't show up on November 6th. His teacher marks him **Absent**.

Within minutes, his mother receives an SMS:

> *"Dear Parent, your child Rahim is absent today (Nov 6). Please contact the school if needed. – Sunrise International School"*

Parents are informed instantly, which also helps the school build trust and safety accountability.

---

### 6.3 Attendance Reporting

**What it does:**
Generates detailed attendance reports filtered by class, date range, or individual student — ideal for identifying patterns.

**Easy Example:**

The Vice-Principal runs an **October Attendance Report**:

| Class | Average Attendance |
|---|---|
| Class 9A | 88% ⚠️ (Lowest) |
| Class 7B | 96% ✅ |
| Class 10A | 93% |

She flags Class 9A for follow-up counseling, as their attendance is significantly below target.

She can also drill down and find: **"Students with more than 5 absences in October"** — and print that list for the class teacher.

---

### 6.4 Hardware Integration Support

**What it does:**
Connects MicroCampus with physical attendance hardware already installed in schools.

**Easy Example:**

A school already has a **biometric fingerprint scanner** at the gate. Instead of switching to a manual system, they integrate it with MicroCampus. When a student scans their fingerprint at 8:30 AM, the attendance record is automatically pushed into MicroCampus — zero manual entry.

**Supported hardware types:**
- RFID card scanners
- Biometric fingerprint readers

---

## 7. Finance & Fee Management Module

> **What it is:** A complete accounting engine for managing everything the school collects (fees) and spends (expenses), with online payment support.

---

### 7.1 Flexible Fee Structure Setup

**What it does:**
Allows admins to define any number of fee types and assign them to specific classes or routes.

**Easy Example:**

The accountant creates the following fee types:

| Fee Type | Amount | Frequency |
|---|---|---|
| Monthly Tuition | ৳1,500 | Monthly |
| Annual Sports Fee | ৳1,000 | Yearly |
| Transport – Mirpur Route | ৳800 | Monthly |

Each class can have a different tuition amount. Transport fees are only applied to students on that route.

---

### 7.2 Individual & Bulk Fee Collection

**What it does:**
Generates invoices for all students in one click, tracks who has and hasn't paid, and sends reminders.

**Easy Example:**

At the start of November:

1. Accountant clicks **"Generate November Invoices"** — all 480 students receive their invoices instantly
2. Accountant opens the **Due List**: *"134 students have not paid as of Nov 10"*
3. Clicks **"Send Reminder SMS"** to all unpaid students' parents
4. As payments come in, the Due List shrinks in real time

---

### 7.3 Online Payment Gateway (Bangladeshi)

**What it does:**
Integrates natively with local payment methods so parents can pay from home without visiting the school.

**Easy Example:**

A parent in Chattogram whose child studies at a Dhaka school pays the November fee at 10 PM:

- Selects **Nagad** → Confirms payment → Done
- The accountant sees the payment recorded in MicroCampus automatically the next morning

**Supported Gateways:**
- bKash
- Nagad
- Rocket
- SSLCommerz (supports all major credit/debit cards and MFS)

---

### 7.4 Printable Receipts

**What it does:**
Generates a formal payment receipt every time a fee is collected — either printed for in-person payments or sent digitally for online payments.

**Easy Example:**

A parent pays ৳1,500 cash at the school counter:

1. Accountant records the payment in MicroCampus
2. Clicks **"Print Receipt"**
3. A 2-copy receipt prints — one for the parent, one for school records

Each receipt includes: Date, Student Name, Fee Type, Amount, Payment Method, and Receipt Number.

---

### 7.5 Expense Management

**What it does:**
Logs all school expenditures under organized categories so the school can track where money is being spent.

**Easy Example:**

In November, the admin records:

| Date | Expense | Category | Amount |
|---|---|---|---|
| Nov 1 | Electricity Bill | Utility | ৳15,000 |
| Nov 30 | Staff Salaries | Payroll | ৳1,20,000 |
| Nov 15 | Whiteboard Markers & Paper | Supplies | ৳3,200 |

These entries feed directly into the financial reports.

---

### 7.6 Financial Reports

**What it does:**
Summarizes income and expenses in clear reports — from monthly snapshots to annual profit & loss statements.

**Easy Example:**

At year-end, the admin generates the **"Annual Finance Summary 2026"**:

| | Amount |
|---|---|
| Total Fee Income | ৳78,00,000 |
| Total Expenses | ৳62,00,000 |
| **Net Surplus** | **৳16,00,000** |

This can be exported to Excel or PDF and shared with the school board.

---

## 8. Examination & Result Management

> **What it is:** End-to-end exam management — from scheduling exams and entering marks to auto-calculating grades and publishing results online.

---

### 8.1 Exam Creation & Schedule

**What it does:**
Creates named exam terms and publishes the subject-wise exam schedule for students and parents.

**Easy Example:**

Admin creates a new exam:
- **Name:** Half-Yearly Exam 2026
- **Math Exam Date:** March 12, 2026 | 10:00 AM – 1:00 PM

This schedule immediately appears on the student and parent portals — no separate notice needed.

---

### 8.2 Flexible Marks Entry

**What it does:**
Teachers can enter marks one by one manually, or upload a CSV file with all marks at once for bulk import.

**Easy Example (Bulk Upload):**

A teacher has 50 students in Class 9B:

1. Downloads the **CSV template** from MicroCampus
2. Opens it in Excel, fills in all 50 students' scores
3. Uploads the single file back to MicroCampus
4. All 50 marks are imported instantly — no repetitive typing

This is especially useful for large classes or multiple subjects.

---

### 8.3 Online Result Publishing

**What it does:**
Publishes the final results to the parent and student portals with a single admin click — making report cards available digitally at a controlled time.

**Easy Example:**

On Result Day:

- At 10:00 AM, the admin clicks **"Publish Results – Class 10"**
- All 65 Class 10 students' report cards become visible on the portal immediately
- Parents receive an automated SMS: *"Your child's results are now available on the portal."*
- No students or parents need to physically visit the school

---

### 8.4 Printable Marksheets & Report Cards

**What it does:**
Automatically generates detailed, professionally formatted PDF report cards for each student.

**Easy Example:**

A parent downloads their child's **Final Report Card PDF**:

| Subject | Marks | Grade | GPA |
|---|---|---|---|
| Mathematics | 91 | A+ | 5.00 |
| English | 78 | A | 4.00 |
| Biology | 83 | A+ | 5.00 |
| ICT | 72 | A | 4.00 |

The card also includes the class teacher's remarks, total GPA, and school seal — ready to be shared or printed.

---

### 8.5 Class Ranking System

**What it does:**
Automatically calculates and generates class and subject-wise student rankings based on final GPA or total marks.

**Easy Example:**

Admin generates a **"Top 10 Students – Class 5 – Final Exam"** ranking list:

| Rank | Student Name | GPA |
|---|---|---|
| 1st | Ayesha Siddiqui | 5.00 |
| 2nd | Tariq Hossain | 4.89 |
| 3rd | Nusrat Jahan | 4.75 |

This list can be printed for prize-giving ceremonies or used internally to identify high-achievers.

---

## 9. Integrated Communication Hub

> **What it is:** The school's official broadcasting system — for sending messages, alerts, and announcements to the right people through the right channels.

---

### 9.1 Multi-Channel Alerts (SMS & Email)

**What it does:**
Lets admins compose a single message and send it simultaneously to targeted groups via SMS or email.

**Easy Example:**

An unexpected situation arises on the morning of November 7th. The admin:

1. Types the message: *"School will be closed tomorrow (Nov 8) due to unavoidable circumstances."*
2. Selects recipients: **All Parents + All Teachers**
3. Selects channel: **SMS**
4. Clicks Send

All parents and teachers receive the SMS within seconds — no phone tree needed.

**Targeting options include:**
- All users
- Specific classes (e.g., only Class 10 parents)
- Specific roles (e.g., only teachers)

---

### 9.2 Digital Noticeboard & Circulars

**What it does:**
A central digital board where official school announcements, circulars, and event notices are posted. Every logged-in user sees it.

**Easy Example:**

Admin posts a notice:
- **Title:** Inter-School Debate Competition – Registrations Open
- **Audience:** All Students & Parents
- **Deadline:** November 20th

The circular appears as a highlighted banner on the home dashboard for every student and parent who logs in — ensuring no one misses it.

---

## 10. Digital Library System

> **What it is:** A digital catalog and circulation desk for the school library — tracking every book, who has borrowed it, and whether any fines are due.

---

### 10.1 Book Catalog & Search

**What it does:**
Digitizes the library's entire book collection so students and staff can search for any book and instantly see its availability.

**Easy Example:**

A student opens the library portal and searches:
- **Title:** Gitanjali | **Author:** Tagore

Result:
> *"Gitanjali by Rabindranath Tagore — 3 copies total | 2 Available ✅ | 1 Issued (Due: Nov 15)"*

The student knows exactly whether to visit the library — without asking the librarian.

---

### 10.2 Issue, Return & Fine Tracking

**What it does:**
Records book issues, tracks return due dates, and automatically calculates overdue fines.

**Easy Example:**

- **Issue date:** Nov 1 | **Due date:** Nov 8
- Student returns the book on **Nov 13** (5 days late)
- System automatically calculates: **5 days × ৳10/day = ৳50 fine**

The librarian sees the fine amount immediately when the book is returned — no manual calculation needed.

---

## 11. Transport & Route Management

> **What it is:** A complete management system for the school's bus fleet — routes, drivers, assigned students, and transport fees.

---

### 11.1 Vehicle, Driver & Route Management

**What it does:**
Creates and manages named transport routes and assigns vehicles and drivers to each.

**Easy Example:**

| Route | Vehicle | Driver | Monthly Fee |
|---|---|---|---|
| Route 1 – Dhanmondi | Bus 5 | Driver Kamal | ৳800 |
| Route 2 – Uttara | Bus 3 | Driver Rafiq | ৳1,000 |
| Route 3 – Mirpur | Bus 7 | Driver Sumon | ৳750 |

All route details are stored — if a driver changes or a bus is serviced, the admin updates it in one place.

---

### 11.2 Student Transport Assignment

**What it does:**
Links a student to a specific route, which automatically adds the transport fee to their monthly invoice.

**Easy Example:**

Admin assigns **Fatima Ahmed → Route 1 (Dhanmondi)**:

- From the next billing cycle, **Transport Fee ৳800** is automatically added to Fatima's monthly invoice
- No manual fee adjustment needed — the system connects transport assignment directly to billing

---

### 11.3 Transport Attendance

**What it does:**
Allows attendance to be taken on the bus itself, ensuring all assigned students have safely boarded.

**Easy Example:**

The bus monitor for Route 1 uses MicroCampus to mark which students boarded the bus each morning. If a student is absent from the bus but marked present in class, the school can identify a discrepancy and contact the parent.

---

## 12. HR & Payroll Management

> **What it is:** A complete HR tool for managing all school staff — their profiles, attendance, leaves, salaries, and payslips.

---

### 12.1 Staff Profiles & Attendance

**What it does:**
Maintains a detailed digital profile for every staff member (teaching and non-teaching) and tracks their daily attendance.

**Easy Example:**

The HR manager searches for **Mrs. Rima Begum (English Teacher)**:

| Field | Info |
|---|---|
| Joining Date | January 5, 2020 |
| Designation | Senior Teacher |
| Contact | 01812-XXXXXX |
| October Attendance | 22/23 days (1 sick leave) |
| Leave Balance | 8 days remaining |

All information is in one place — no paper files.

---

### 12.2 Leave Management System

**What it does:**
Digitizes the entire leave application and approval process — no paper forms, no chasing the admin.

**Easy Example:**

1. Teacher **Mr. Hasan** feels ill. He opens his portal and submits a **Sick Leave** request for **Nov 7**.
2. Admin receives a notification and reviews the request.
3. Admin clicks **"Approve"**.
4. Mr. Hasan is notified by the system, and **1 sick leave** is automatically deducted from his annual quota.
5. His attendance record for Nov 7 shows: **Sick Leave (Approved)** — not Absent.

---

### 12.3 Automated Salary Generation

**What it does:**
Calculates each staff member's monthly salary automatically, applying custom allowances and deductions based on attendance and HR settings.

**Easy Example:**

At the end of November, admin runs **"Generate November Salaries"**:

| Staff | Basic | House Rent Allowance | Deduction (2 Absent Days) | Net Salary |
|---|---|---|---|---|
| Mrs. Salma | ৳25,000 | ৳8,000 | -৳2,174 | ৳30,826 |
| Mr. Hasan | ৳22,000 | ৳7,000 | ৳0 | ৳29,000 |

Every calculation is automatic — no spreadsheet needed.

---

### 12.4 Payslip Generation

**What it does:**
After payroll is run, the system automatically generates a detailed payslip for each staff member and emails it to them.

**Easy Example:**

After running November payroll, every teacher and staff member receives an email:

> **Subject:** Your Payslip for November 2026 – Sunrise International School

The attached PDF shows:
- Basic Salary, Allowances (itemized), Deductions (itemized)
- Net Pay, Payment Date, and Payment Method

Staff never need to visit the HR office to collect a payslip.

---

## 13. Advanced Reporting & Analytics Dashboard

> **What it is:** The intelligence layer of MicroCampus — turning raw data into meaningful insights for better decision-making across attendance, finances, and academic performance.

---

### 13.1 Attendance Analytics

**What it does:**
Goes beyond simple attendance records to reveal patterns and flag at-risk students.

**Summary Report Example:**
> *"October 2026 – Class 7A Average Attendance: 89%"*

**Actionable Report Example:**
> The Vice-Principal runs: *"Students with more than 5 absences in October"* and gets a list of 12 students. These students are referred to the counselor for a follow-up conversation.

---

### 13.2 Financial Analytics

**What it does:**
Tracks fee collection progress and gives a full financial health picture of the school.

**Collection Progress Example:**
> *"November Fee Collection – Class 9: 30 paid out of 43 students."*
The accountant sees exactly who is outstanding and can target reminders.

**Annual Overview Example:**
> The school board reviews the **"Annual Finance Summary 2026"** — Total Income vs Total Expenses — and decides to increase the sports fee for next year based on the surplus data.

---

### 13.3 Academic Performance Analytics

**What it does:**
Multi-dimensional analysis of exam results — across terms, between classes, between subjects, and across demographics.

**Example 1 – Term-over-Term Progress:**
> *Class 9A: Term 1 GPA → 3.82 | Term 2 GPA → 4.11 (+0.29 improvement)*

Identifies if a class is improving or declining over time.

**Example 2 – Class Comparison:**
> *Class 7A vs Class 7B (Science): 7A Avg 75% | 7B Avg 78%*

Helps the principal identify which section may need more support.

**Example 3 – Individual Highlighting:**
> *"Student Ayesha is performing +5% above the class average"* — used to recognize high-achievers.

**Example 4 – Gender-Based Performance:**
> *"Class 10 – Boys: Avg GPA 3.89 | Girls: Avg GPA 4.01"*

Helps identify gender-based learning gaps and design targeted support programs.

**Example 5 – Subject Difficulty Trend:**
> A bar graph shows **ICT** has the lowest average score across all Class 10 sections. This triggers a decision to arrange teacher training for the ICT department.

---

### 13.4 Data Export

**What it does:**
Any report or data table in MicroCampus can be downloaded in multiple formats.

**Easy Example:**

| Use Case | Export Format |
|---|---|
| Full Student List (for registers) | Excel (.xlsx) |
| Final Marksheet (for printing) | PDF |
| Attendance Report (for board meeting) | Excel |
| Fee Due List | Excel |

Export is available from virtually every report screen.

---

## 14. System Settings & Customization

> **What it is:** The configuration layer that makes MicroCampus feel like the school's own platform.

---

### 14.1 Multi-Language Support

> ⚠️ **Note:** Multi-language support is **not available by default**. The default interface language is **English**. Bangla support is planned/optional.

**What it does (when available):**
Lets each user choose their preferred interface language — so admin may work in English while a parent navigates in Bangla.

**Example:**
- Admin Portal → Language: English
- Parent Portal → Language: বাংলা (Bangla)

---

### 14.2 Theme & Brand Customization

**What it does:**
Personalizes the visual identity of the platform to match the school's brand — logo, colors, and system name.

**Easy Example:**

A school with a green and white brand identity:

1. Uploads school logo → Appears on login page, reports, receipts, and admit cards
2. Changes portal color from **default blue → school green**
3. Sets system title: **"Bright Future Academy – ERP"**

Every user who logs in sees a portal that feels like it belongs to their school, not a generic software.

---

## 15. Future Roadmap (Planned Modules)

> These modules are **in development** and not yet available. They represent the next phase of MicroCampus's expansion.

---

### 15.1 Online Admission Portal *(Coming Soon)*

**What it will do:**
A public-facing webpage where new parents can apply for admission entirely online — no need to visit the school for forms.

**Planned Features & Example:**
1. Parent visits the school's online admission link
2. Fills in a **customizable admission form** (the admin designs the fields)
3. Uploads required documents (birth certificate, previous report card, photo)
4. Pays the **application fee online** (bKash/Nagad/SSLCommerz)
5. Gets a confirmation and can **track their application status** in real time:
   > *"Application No. ADM-2027-012 — Status: Under Review"*

This eliminates long queues on admission days and opens the school to out-of-town applicants.

---

### 15.2 Hostel (Dormitory) Management *(Coming Soon)*

**What it will do:**
A full management system for schools with residential facilities.

**Planned Features & Example:**

| Feature | Example |
|---|---|
| Room & Bed Allocation | Assign Student Tariq to **Room 12, Bed B** |
| Hostel-Specific Fees | ৳5,000/month Hostel Fee auto-added to his invoice |
| Hostel Attendance | Morning roll call logged in the system |
| Visitor Log | Record that Tariq's father visited on Nov 10 at 3 PM |

Residential schools will be able to manage their hostel operations with the same ease as their academic operations.

---

## Summary: MicroCampus at a Glance

| # | Module | Key Benefit |
|---|---|---|
| 1 | Central Administration | One dashboard to run the whole school |
| 2 | Academic Management | Build timetables, assign teachers, prevent conflicts |
| 3 | Student Information System | Full digital student file from Day 1 |
| 4 | Parent Portal | Parents stay informed without calling the school |
| 5 | Teacher Dashboard | Fast attendance and mark entry from any device |
| 6 | Smart Attendance | Auto-SMS to parents when a child is absent |
| 7 | Finance & Fee Management | Online payments, bulk invoicing, P&L reports |
| 8 | Examination & Results | Publish results online, generate report cards in seconds |
| 9 | Communication Hub | SMS/email broadcasts to targeted groups |
| 10 | Digital Library | Book catalog, issue/return, auto-fines |
| 11 | Transport Management | Route-to-fee automation, bus attendance |
| 12 | HR & Payroll | Leave requests, auto-salary, email payslips |
| 13 | Analytics Dashboard | Data-driven insights across all school operations |
| 14 | System Settings | Brand it your school's own platform |
| 15 | Future Roadmap | Online admissions & hostel management coming soon |

---

*This document is intended for internal use by the MicroCampus Marketing & Sales Team. All examples use fictional but realistic Bangladeshi school data for illustrative purposes.*