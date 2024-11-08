import React, { useEffect, useState } from "react";

const AdminPanel = () => {
  const [submissions, setSubmissions] = useState([]);

  const fetchSubmissions = async () => {
    const response = await fetch(contact_form_ajax.ajax_url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        action: "get_contact_form_submissions",
        nonce: contact_form_ajax.nonce,
      }),
    });

    const result = await response.json();
    if (result.success) {
      setSubmissions(result.data);
    }
  };

  useEffect(() => {
    fetchSubmissions();
  }, []);

  return (
    <div className="p-6">
      <h2 className="text-2xl font-semibold mb-6">Form Submissions</h2>
      <div className="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table className="min-w-full table-auto">
          <thead className="bg-gray-100">
            <tr>
              <th className="py-2 px-4 border-b text-left text-gray-600">
                Name
              </th>
              <th className="py-2 px-4 border-b text-left text-gray-600">
                Email
              </th>
              <th className="py-2 px-4 border-b text-left text-gray-600">
                Message
              </th>
            </tr>
          </thead>
          <tbody>
            {submissions.length > 0 ? (
              submissions.map((submission, index) => (
                <tr key={index}>
                  <td className="py-2 px-4 border-b text-gray-700">
                    {submission.name}
                  </td>
                  <td className="py-2 px-4 border-b text-gray-700">
                    {submission.email}
                  </td>
                  <td className="py-2 px-4 border-b text-gray-700">
                    {submission.message}
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="3" className="py-4 px-4 text-center text-gray-500">
                  No submissions yet
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default AdminPanel;
