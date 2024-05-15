import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler
from sklearn.linear_model import LogisticRegression
from sklearn.metrics import accuracy_score, classification_report, confusion_matrix

df = pd.read_csv("Files/proj_web/company_data.csv")
X = df.drop(columns=["class"])
y = df["class"]


# One-hot encoding on categorical variables, split data
X_encoded = pd.get_dummies(X)
X_train, X_test, y_train, y_test = train_test_split(X_encoded, y, test_size=0.2, random_state=42)

# Scaling the features
scaler = StandardScaler()
X_train_scaled = scaler.fit_transform(X_train)
X_test_scaled = scaler.transform(X_test)

# Logistic R- with class weights
model = LogisticRegression(class_weight='balanced')
model.fit(X_train_scaled, y_train)

# Make predictions on the testing data
# Evaluate the model's performance
y_pred = model.predict(X_test_scaled)

accuracy = accuracy_score(y_test, y_pred)
# print("Accuracy:", accuracy)

c_report = classification_report(y_test, y_pred)
# print("Classification Report:\n", c_report)

c_matrix = confusion_matrix(y_test, y_pred)
# print("Confusion Matrix:\n", c_matrix)

# Count the number of individuals predicted to be promoted and not promoted
promoted_count = sum(y_pred == ' >50K')
not_promoted_count = sum(y_pred == ' <=50K')
# print("predicted to be promoted:", promoted_count)
# print("predicted not to be promoted:", not_promoted_count)


# Retrieving coefficients from the logistic regression model
coefficients = model.coef_[0]

# Pair feature names with coefficients
feature_coefficients = dict(zip(X.columns, coefficients))

# Sort feature coefficients by their absolute values
sorted_feature_coefficients = sorted(feature_coefficients.items(), key=lambda x: abs(x[1]), reverse=True)
coefficients_list = []

category, values = [], []
for feature, coefficient in sorted_feature_coefficients:
    category.append(feature); values.append(round(float(coefficient), 2))
    
# sorted_feature_coefficients
    





promotion_mapping = {' <=50K': 0, ' >50K': 1}
df['is_promoted'] = df['class'].map(promotion_mapping)
# Drop the original 'class' column if no longer needed
df.drop(columns=['class'], inplace=True)
# Display the modified DataFrame
# print(df.head())








    

categorical_cols = df.select_dtypes(include=['object']).columns
df_encoded = pd.get_dummies(df, columns=categorical_cols)
corr_matrix = df_encoded.corr()

corr_matrix["is_promoted"].sort_values(ascending=False)
# print(corr_matrix)

h = corr_matrix["is_promoted"].sort_values(ascending=False).head()
t = corr_matrix["is_promoted"].sort_values(ascending=False).tail()

med = corr_matrix["is_promoted"].median()
less_m = corr_matrix[corr_matrix["is_promoted"] < med]
m = less_m["is_promoted"].sort_values(ascending=True).head()

# print(f"{h} \n\n{t} \n\n{m}")
print(m)

# predictors figures
import matplotlib.pyplot as plt
# plt.tight_layout()
plt.figure(figsize=(8,4))
# h.plot(kind="barh", xlabel="Correlation", ylabel="Features", title= "Top Correlated Features to promotion")
# plt.tight_layout()
# plt.savefig("Files/proj_web/Figures/head_predictor.png")


# t.plot(kind="barh", xlabel="Correlation", ylabel="Features", title= "Top Correlated Features to 'no promotion'")
# plt.tight_layout()
# plt.savefig("Files/proj_web/Figures/tail_predictor.png")

# m.plot(kind="barh", xlabel="Correlation", ylabel="Features", title= "Features that affect the prediction less")

sorted_corr = corr_matrix["is_promoted"].abs().sort_values()
median_values = corr_matrix.loc[sorted_corr.index[:5], "is_promoted"]
median_based_on_values = median_values.median()
median_values.plot(kind="barh", xlabel="Correlation", ylabel="Features", title= "Features that do 'no' or close to 'no effect' on predictions")

plt.tight_layout()
plt.savefig("Files/proj_web/Figures/no_predictor.png")

plt.show()